{{-- resources/views/checkout/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header Section --}}
    <div class="mb-10">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 bg-gradient-to-r from-green-600 to-emerald-600 rounded-xl flex items-center justify-center">
                <i class="fas fa-credit-card text-white text-xl"></i>
            </div>
            <h1 class="text-4xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                Checkout Pembayaran
            </h1>
        </div>
        
        {{-- Progress Steps --}}
        <div class="flex items-center gap-4 mt-6">
            <div class="flex items-center">
                <div class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center font-bold">
                    <i class="fas fa-check"></i>
                </div>
                <span class="ml-3 text-sm font-semibold text-green-600">Keranjang</span>
            </div>
            <div class="flex-1 h-1 bg-green-500"></div>
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gradient-to-r from-green-600 to-emerald-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                    2
                </div>
                <span class="ml-3 text-sm font-semibold text-gray-900">Checkout</span>
            </div>
            <div class="flex-1 h-1 bg-gray-300"></div>
            <div class="flex items-center">
                <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                    3
                </div>
                <span class="ml-3 text-sm font-semibold text-gray-500">Selesai</span>
            </div>
        </div>
    </div>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- Shipping Info & Order Items --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Shipping Information --}}
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                            <i class="fas fa-shipping-fast text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Informasi Pengiriman</h2>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <i class="fas fa-user mr-2 text-indigo-600"></i>
                                Nama Penerima *
                            </label>
                            <input type="text" name="recipient_name" value="{{ old('recipient_name', auth()->user()->name) }}" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 @error('recipient_name') border-red-500 @enderror"
                                placeholder="Masukkan nama penerima">
                            @error('recipient_name')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <i class="fas fa-map-marker-alt mr-2 text-indigo-600"></i>
                                Alamat Lengkap *
                            </label>
                            <textarea name="deliver_to" rows="4" required
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 @error('deliver_to') border-red-500 @enderror"
                                placeholder="Jl. Contoh No. 123, Kecamatan, Kota, Provinsi, Kode Pos">{{ old('deliver_to') }}</textarea>
                            @error('deliver_to')
                                <p class="text-red-500 text-sm mt-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-2 flex items-center">
                                <i class="fas fa-ticket-alt mr-2 text-indigo-600"></i>
                                Kode Pembayaran (Opsional)
                            </label>
                            <div class="relative">
                                <input type="text" name="payment_code" value="{{ old('payment_code') }}"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300"
                                    placeholder="Masukkan kode promo atau voucher">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:shadow-lg transition-all duration-300">
                                        Terapkan
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mt-2 flex items-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Masukkan kode jika Anda memiliki voucher atau kode promo
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Order Items --}}
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-600 to-pink-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-bag text-white"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900">Pesanan Anda</h2>
                        </div>
                        <span class="bg-indigo-100 text-indigo-700 px-4 py-2 rounded-full text-sm font-semibold">
                            {{ $carts->sum('quantity') }} Item
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        @foreach($carts as $cart)
                        <div class="flex gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all duration-300">
                            <div class="relative group flex-shrink-0">
                                <img src="{{ $cart->alatMusik->gambar ? asset('storage/' . $cart->alatMusik->gambar) : 'https://via.placeholder.com/100' }}" 
                                     alt="{{ $cart->alatMusik->nama_alat }}" 
                                     class="w-24 h-24 object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
                                <div class="absolute -top-2 -right-2 w-7 h-7 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full flex items-center justify-center text-xs font-bold shadow-lg">
                                    {{ $cart->quantity }}
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 mb-2 truncate">{{ $cart->alatMusik->nama_alat }}</h3>
                                <div class="flex items-center gap-4 text-sm text-gray-600 mb-2">
                                    <span class="flex items-center">
                                        <i class="fas fa-box mr-1"></i>
                                        {{ $cart->quantity }}x
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-tag mr-1"></i>
                                        Rp {{ number_format($cart->alatMusik->harga, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right flex-shrink-0">
                                <p class="text-xs text-gray-500 mb-1">Subtotal</p>
                                <p class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($cart->getSubtotal(), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl p-6 sticky top-24 border border-gray-100">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-green-600 to-emerald-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-receipt text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Ringkasan Pesanan</h2>
                    </div>
                    
                    <div class="space-y-4 mb-6">
                        <div class="bg-gray-50 p-4 rounded-xl space-y-3">
                            <div class="flex justify-between items-center text-gray-600">
                                <span class="flex items-center">
                                    <i class="fas fa-shopping-bag mr-2 text-indigo-600"></i>
                                    Subtotal ({{ $carts->sum('quantity') }} item)
                                </span>
                                <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600">
                                <span class="flex items-center">
                                    <i class="fas fa-shipping-fast mr-2 text-green-600"></i>
                                    Ongkos Kirim
                                </span>
                                <span class="font-semibold text-green-600">Gratis</span>
                            </div>
                            <div class="flex justify-between items-center text-gray-600">
                                <span class="flex items-center">
                                    <i class="fas fa-tags mr-2 text-orange-600"></i>
                                    Diskon
                                </span>
                                <span class="font-semibold text-orange-600">- Rp 0</span>
                            </div>
                        </div>

                        <hr class="border-gray-200">

                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-xl">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-900">Total Pembayaran</span>
                                <span class="text-3xl font-bold bg-gradient-to-r from-green-600 to-emerald-600 bg-clip-text text-transparent">
                                    Rp {{ number_format($total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 font-bold text-lg flex items-center justify-center">
                            <i class="fas fa-check-circle mr-3"></i>
                            Konfirmasi & Bayar
                        </button>

                        <a href="{{ route('cart.index') }}" class="block w-full text-center bg-gray-100 text-gray-700 py-3 rounded-xl hover:bg-gray-200 transition-all duration-300 font-semibold">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Keranjang
                        </a>
                    </div>

                    {{-- Payment Methods Info --}}
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <p class="text-xs text-gray-600 mb-3 font-semibold">Metode Pembayaran:</p>
                        <div class="flex flex-wrap gap-2">
                            <div class="bg-white border border-gray-200 rounded-lg px-3 py-2 text-xs font-semibold text-gray-700">
                                <i class="fas fa-credit-card mr-1 text-blue-600"></i>Kartu
                            </div>
                            <div class="bg-white border border-gray-200 rounded-lg px-3 py-2 text-xs font-semibold text-gray-700">
                                <i class="fas fa-university mr-1 text-green-600"></i>Transfer
                            </div>
                            <div class="bg-white border border-gray-200 rounded-lg px-3 py-2 text-xs font-semibold text-gray-700">
                                <i class="fas fa-wallet mr-1 text-purple-600"></i>E-Wallet
                            </div>
                        </div>
                    </div>

                    {{-- Security Badge --}}
                    <div class="mt-6 flex items-center justify-center gap-2 text-xs text-gray-500">
                        <i class="fas fa-lock text-green-600"></i>
                        <span>Pembayaran 100% Aman</span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection