<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $carts = Cart::with('alatMusik')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong');
        }

        $total = $carts->sum(function ($cart) {
            return $cart->getSubtotal();
        });

        return view('checkout.index', compact('carts', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'deliver_to' => 'required|string',
            'payment_code' => 'nullable|string|max:50',
        ]);

        $carts = Cart::with('alatMusik')
            ->where('user_id', auth()->id())
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja Anda kosong');
        }

        DB::beginTransaction();
        try {
            // Calculate total
            $totalAmount = $carts->sum(function ($cart) {
                return $cart->getSubtotal();
            });

            // Create transaction
            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'transaction_code' => 'TRX-' . strtoupper(Str::random(10)),
                'recipient_name' => $request->recipient_name,
                'deliver_to' => $request->deliver_to,
                'payment_code' => $request->payment_code,
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // Create transaction details
            foreach ($carts as $cart) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'alat_musik_id' => $cart->alat_musik_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->alatMusik->harga,
                    'subtotal' => $cart->getSubtotal(),
                ]);

                // Update stock
                $alatMusik = $cart->alatMusik;
                $alatMusik->stok -= $cart->quantity;
                $alatMusik->save();
            }

            // Clear cart
            Cart::where('user_id', auth()->id())->delete();

            DB::commit();

            // REDIRECT KE HALAMAN PAYMENT
            return redirect()->route('checkout.payment', $transaction)
                ->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function payment(Transaction $transaction)
    {
        // Check ownership
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Get active payment methods
        $paymentMethods = PaymentMethod::where('is_active', true)->get();

        return view('checkout.payment', compact('transaction', 'paymentMethods'));
    }

  public function uploadPaymentProof(Request $request, Transaction $transaction)
{
    // Check ownership
    if ($transaction->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    ], [
        'payment_proof.required' => 'Bukti pembayaran wajib diupload',
        'payment_proof.image' => 'File harus berupa gambar',
        'payment_proof.mimes' => 'Format file harus jpeg, png, atau jpg',
        'payment_proof.max' => 'Ukuran file maksimal 2MB',
    ]);

    try {
        // Delete old payment proof if exists
        if ($transaction->payment_proof) {
            Storage::disk('public')->delete($transaction->payment_proof);
        }

        // Store new payment proof
        $path = $request->file('payment_proof')->store('payment-proofs', 'public');

        // Update transaction
        $transaction->update([
            'payment_proof' => $path,
            'status' => 'pending', // Tetap pending sampai admin konfirmasi
        ]);

        // Redirect ke detail transaksi
        return redirect()->route('transactions.show', $transaction)
            ->with('success', 'Bukti pembayaran berhasil diupload! Pesanan Anda sedang diverifikasi oleh admin.');

    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Gagal mengupload bukti pembayaran: ' . $e->getMessage());
    }
}
}