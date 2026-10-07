@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header Section --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-shopping-cart text-white text-xl"></i>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                Keranjang Belanja
            </h1>
        </div>
        <p class="text-gray-600 ml-15">Kelola produk yang ingin Anda beli</p>
    </div>

    @if($carts->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Cart Items --}}
            <div class="lg:col-span-2 space-y-4">
                @foreach($carts as $cart)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                    <div class="p-6">
                        <div class="flex gap-6">
                            {{-- Product Image --}}
                            <div class="relative group flex-shrink-0">
                                <img src="{{ $cart->alatMusik->gambar ? asset('storage/' . $cart->alatMusik->gambar) : 'https://via.placeholder.com/150' }}" 
                                     alt="{{ $cart->alatMusik->nama_alat }}" 
                                     class="w-32 h-32 object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 rounded-xl transition-all duration-300"></div>
                            </div>
                            
                            {{-- Product Info --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2 hover:text-indigo-600 transition-colors truncate">
                                            {{ $cart->alatMusik->nama_alat }}
                                        </h3>
                                        <div class="flex items-center gap-2 text-sm text-gray-600 mb-3">
                                            <i class="fas fa-map-marker-alt text-blue-500"></i>
                                            <span>{{ $cart->alatMusik->daerah->nama_daerah }}</span>
                                        </div>
                                    </div>
                                    
                                    {{-- Delete Button --}}
                                    <form action="{{ route('cart.destroy', $cart) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 hover:scale-110 transition-all duration-300 flex items-center justify-center" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                {{-- Price per Item --}}
                                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-3 rounded-xl mb-4">
                                    <p class="text-xs text-gray-600 mb-1">Harga per item</p>
                                    <p class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                        Rp {{ number_format($cart->alatMusik->harga, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Quantity Control --}}
                                <div class="flex items-center gap-4">
                                    <form action="{{ route('cart.update', $cart) }}" method="POST" class="flex items-center gap-3">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center">
                                            <label class="text-sm font-semibold text-gray-700 mr-3">Jumlah:</label>
                                            <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                                                <button type="button" onclick="this.nextElementSibling.stepDown(); this.form.submit();" 
                                                    class="px-3 py-2 bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <i class="fas fa-minus text-gray-600 text-sm"></i>
                                                </button>
                                                <input type="number" name="quantity" value="{{ $cart->quantity }}" 
                                                    min="1" max="{{ $cart->alatMusik->stok }}" 
                                                    class="w-16 text-center py-2 border-0 focus:outline-none focus:ring-0 font-semibold text-gray-900"
                                                    onchange="this.form.submit()">
                                                <button type="button" onclick="this.previousElementSibling.stepUp(); this.form.submit();" 
                                                    class="px-3 py-2 bg-gray-50 hover:bg-gray-100 transition-colors">
                                                    <i class="fas fa-plus text-gray-600 text-sm"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="text-xs text-gray-500">
                                        <i class="fas fa-box mr-1"></i>
                                        Stok: {{ $cart->alatMusik->stok }}
                                    </div>
                                </div>
                            </div>

                            {{-- Subtotal --}}
                            <div class="text-right flex-shrink-0">
                                <p class="text-sm text-gray-600 mb-2">Subtotal</p>
                                <div class="bg-gradient-to-br from-green-50 to-green-100 px-4 py-3 rounded-xl">
                                    <p class="text-2xl font-bold text-green-700">
                                        Rp {{ number_format($cart->getSubtotal(), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-24 border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-receipt text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Ringkasan Pesanan</h2>
                    </div>
                    
                    {{-- Order Details --}}
                    <div class="space-y-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-xl">
                            <div class="flex justify-between items-center mb-3">
                                <span class="text-gray-600 flex items-center">
                                    <i class="fas fa-shopping-bag mr-2 text-indigo-600"></i>
                                    Total Item
                                </span>
                                <span class="font-bold text-gray-900">{{ $carts->sum('quantity') }} item</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 flex items-center">
                                    <i class="fas fa-calculator mr-2 text-purple-600"></i>
                                    Subtotal
                                </span>
                                <span class="font-bold text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- Promo Code --}}
                        <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-4 rounded-xl border border-yellow-200">
                            <div class="flex items-start gap-2">
                                <i class="fas fa-ticket-alt text-yellow-600 mt-1"></i>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-gray-900 mb-1">Punya kode promo?</p>
                                    <input type="text" placeholder="Masukkan kode promo" 
                                        class="w-full px-3 py-2 border border-yellow-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        {{-- Total --}}
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 p-4 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-semibold text-gray-900">Total Pembayaran</span>
                                <span class="text-3xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="space-y-3">
                        <a href="{{ route('checkout.index') }}" 
                           class="block w-full text-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 font-bold text-lg">
                            <i class="fas fa-credit-card mr-2"></i>
                            Lanjut ke Pembayaran
                        </a>

                        <a href="{{ route('catalog.index') }}" 
                           class="block w-full text-center bg-gray-100 text-gray-700 py-3 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Lanjut Belanja
                        </a>
                    </div>

                    {{-- Security Badge --}}
                    <div class="mt-6 flex items-center justify-center gap-3 text-xs text-gray-500">
                        <i class="fas fa-shield-alt text-green-600"></i>
                        <span>Transaksi Aman & Terpercaya</span>
                    </div>
                </div>
            </div>
        </div>
    @else
        {{-- Empty Cart --}}
        <div class="text-center py-20 bg-white rounded-2xl shadow-xl border border-gray-100">
            <div class="inline-block p-8 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full mb-6">
                <i class="fas fa-shopping-cart text-6xl text-gray-400"></i>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-3">Keranjang Belanja Kosong</h3>
            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                Belum ada produk di keranjang Anda. Yuk, mulai belanja sekarang dan temukan alat musik impian Anda!
            </p>
            <a href="{{ route('catalog.index') }}" 
               class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-4 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 font-bold text-lg">
                <i class="fas fa-store mr-2"></i>
                Mulai Belanja
            </a>
        </div>
    @endif
</div>

<style>
    /* Hide spinner buttons on number input */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
@endsection