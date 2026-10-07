<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'transactionDetails.alatMusik']);

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        $transactions = $query->latest()->paginate(15);

        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['user', 'transactionDetails.alatMusik']);

        return view('admin.transactions.show', compact('transaction'));
    }

    public function updateStatus(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,completed,cancelled',
        ]);

        $transaction->updateStatus($validated['status']);

        return redirect()->back()
            ->with('success', 'Status transaksi berhasil diupdate');
    }

    // Method baru untuk konfirmasi pembayaran
    public function confirmPayment(Transaction $transaction)
    {
        $transaction->update([
            'status' => 'confirmed',
            'paid_at' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function rejectPayment(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'rejection_note' => 'required|string',
        ]);

        // Hapus bukti transfer
        if ($transaction->payment_proof) {
            Storage::disk('public')->delete($transaction->payment_proof);
        }

        $transaction->update([
            'payment_proof' => null,
            'status' => 'pending',
        ]);

        return redirect()->back()
            ->with('success', 'Pembayaran ditolak. Customer diminta upload ulang');
    }
}