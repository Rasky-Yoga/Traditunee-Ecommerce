<?php
// app/Http/Controllers/CartController.php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\AlatMusik;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::with('alatMusik.daerah')
            ->where('user_id', auth()->id())
            ->get();

        $total = $carts->sum(function ($cart) {
            return $cart->getSubtotal();
        });

        return view('cart.index', compact('carts', 'total'));
    }

    public function add(Request $request, AlatMusik $alatMusik)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($alatMusik->stok < $validated['quantity']) {
            return redirect()->back()
                ->with('error', 'Stok tidak mencukupi');
        }

        $cart = Cart::where('user_id', auth()->id())
            ->where('alat_musik_id', $alatMusik->id)
            ->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $validated['quantity'];
            
            if ($alatMusik->stok < $newQuantity) {
                return redirect()->back()
                    ->with('error', 'Stok tidak mencukupi');
            }
            
            $cart->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'alat_musik_id' => $alatMusik->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()->back()
            ->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if ($cart->alatMusik->stok < $validated['quantity']) {
            return redirect()->back()
                ->with('error', 'Stok tidak mencukupi');
        }

        $cart->update($validated);

        return redirect()->back()
            ->with('success', 'Keranjang berhasil diupdate');
    }

    public function destroy(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->back()
            ->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
