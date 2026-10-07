{{-- resources/views/catalog/show.blade.php --}}
@extends('layouts.app')

@section('title', $alatMusik->nama_alat)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-gray-600 mb-8">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">
            <i class="fas fa-home"></i>
        </a>
        <i class="fas fa-chevron-right text-xs"></i>
        <a href="{{ route('catalog.index') }}" class="hover:text-indigo-600 transition-colors">Katalog</a>
        <i class="fas fa-chevron-right text-xs"></i>
        <span class="text-indigo-600 font-medium">{{ $alatMusik->nama_alat }}</span>
    </nav>

    {{-- Product Detail Section --}}
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-12 border border-gray-100">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8 lg:p-12">
            {{-- Product Image --}}
            <div class="space-y-4">
                <div class="relative group overflow-hidden rounded-2xl bg-gray-100">
                    <img src="{{ $alatMusik->gambar ? asset('storage/' . $alatMusik->gambar) : 'https://via.placeholder.com/600x400' }}" 
                         alt="{{ $alatMusik->nama_alat }}" 
                         class="w-full h-auto object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    {{-- Stock Badge --}}
                    <div class="absolute top-6 left-6">
                        @if($alatMusik->stok > 0)
                            <span class="bg-green-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-xl flex items-center backdrop-blur-sm bg-opacity-90">
                                <i class="fas fa-check-circle mr-2"></i>Tersedia
                            </span>
                        @else
                            <span class="bg-red-500 text-white text-sm font-bold px-4 py-2 rounded-full shadow-xl flex items-center backdrop-blur-sm bg-opacity-90">
                                <i class="fas fa-times-circle mr-2"></i>Stok Habis
                            </span>
                        @endif
                    </div>

                    {{-- Wishlist Button --}}
                    <button class="absolute top-6 right-6 w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 hover:bg-white transition-all duration-300 shadow-lg hover:scale-110">
                        <i class="far fa-heart text-xl"></i>
                    </button>
                </div>

                {{-- Product Features --}}
                <div class="grid grid-cols-3 gap-3">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-xl text-center">
                        <i class="fas fa-shield-alt text-2xl text-blue-600 mb-2"></i>
                        <p class="text-xs font-semibold text-gray-700">Garansi Resmi</p>
                    </div>
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-xl text-center">
                        <i class="fas fa-truck text-2xl text-green-600 mb-2"></i>
                        <p class="text-xs font-semibold text-gray-700">Gratis Ongkir</p>
                    </div>
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl text-center">
                        <i class="fas fa-star text-2xl text-purple-600 mb-2"></i>
                        <p class="text-xs font-semibold text-gray-700">Kualitas Terbaik</p>
                    </div>
                </div>
            </div>

            {{-- Product Info --}}
            <div class="space-y-6">
                {{-- Title --}}
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">{{ $alatMusik->nama_alat }}</h1>
                    
                    <div class="flex items-center gap-2 mb-3">
                        <div class="flex items-center">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-yellow-400 text-sm"></i>
                            @endfor
                        </div>
                        <span class="text-sm text-gray-600">(4.8/5.0)</span>
                        <span class="text-sm text-gray-400">•</span>
                        <span class="text-sm text-gray-600">127 reviews</span>
                    </div>
                </div>

                {{-- Info Cards --}}
                <div class="grid grid-cols-2 gap-3">
                    <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-4 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Daerah Asal</p>
                                <p class="font-semibold text-gray-900">{{ $alatMusik->daerah->nama_daerah }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-xl">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center">
                                <i class="fas fa-tag text-white"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600">Kategori</p>
                                <p class="font-semibold text-gray-900">{{ $alatMusik->kategori->nama_kategori }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Price Section --}}
                <div class="bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 p-6 rounded-2xl border-2 border-indigo-100">
                    <p class="text-sm text-gray-600 mb-2">Harga Special</p>
                    <div class="flex items-end gap-3">
                        <span class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                            Rp {{ number_format($alatMusik->harga, 0, ',', '.') }}
                        </span>
                        <span class="text-sm text-gray-500 line-through mb-2">
                            Rp {{ number_format($alatMusik->harga * 1.2, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="mt-3 inline-block bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                        <i class="fas fa-fire mr-1"></i>Hemat 20%
                    </div>
                </div>

                {{-- Stock Info --}}
                <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-box text-2xl {{ $alatMusik->stok > 0 ? 'text-green-600' : 'text-red-600' }}"></i>
                            <div>
                                <p class="text-sm text-gray-600">Ketersediaan Stok</p>
                                <p class="font-bold {{ $alatMusik->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $alatMusik->stok > 0 ? $alatMusik->stok . ' unit tersedia' : 'Stok habis' }}
                                </p>
                            </div>
                        </div>
                        @if($alatMusik->stok > 0 && $alatMusik->stok <= 5)
                            <span class="text-xs bg-orange-100 text-orange-600 px-3 py-1 rounded-full font-semibold">
                                <i class="fas fa-exclamation-triangle mr-1"></i>Stok Terbatas
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Description --}}
                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-align-left mr-2 text-indigo-600"></i>
                        Deskripsi Produk
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $alatMusik->deskripsi }}</p>
                </div>

                {{-- Action Buttons --}}
                @auth
                    @if(auth()->user()->isCustomer())
                        @if($alatMusik->stok > 0)
                            <form action="{{ route('cart.add', $alatMusik) }}" method="POST" class="space-y-4">
                                @csrf
                                <div class="flex items-center gap-4">
                                    <div class="flex-shrink-0">
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah</label>
                                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                                            <button type="button" onclick="decreaseQty()" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 transition-colors">
                                                <i class="fas fa-minus text-gray-600"></i>
                                            </button>
                                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $alatMusik->stok }}" 
                                                class="w-20 text-center py-3 border-0 focus:outline-none focus:ring-0 font-semibold text-gray-900">
                                            <button type="button" onclick="increaseQty()" class="px-4 py-3 bg-gray-100 hover:bg-gray-200 transition-colors">
                                                <i class="fas fa-plus text-gray-600"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="flex gap-3">
                                    <button type="submit" class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 font-bold text-lg flex items-center justify-center">
                                        <i class="fas fa-shopping-cart mr-3"></i>
                                        Tambah ke Keranjang
                                    </button>
                                    <button type="button" class="w-14 h-14 bg-gray-100 text-gray-700 rounded-xl hover:bg-red-100 hover:text-red-600 transition-all duration-300 flex items-center justify-center">
                                        <i class="far fa-heart text-xl"></i>
                                    </button>
                                </div>
                            </form>
                        @else
                            <button disabled class="w-full bg-gray-300 text-gray-500 py-4 rounded-xl cursor-not-allowed font-bold text-lg flex items-center justify-center">
                                <i class="fas fa-ban mr-3"></i>
                                Stok Habis
                            </button>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300 font-bold text-lg">
                        <i class="fas fa-sign-in-alt mr-3"></i>
                        Login untuk Membeli
                    </a>
                @endauth

                {{-- Additional Info --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <i class="fas fa-info-circle text-blue-600 text-xl mt-1"></i>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Informasi Penting:</p>
                            <ul class="space-y-1 text-blue-700">
                                <li>• Produk 100% original dan bergaransi</li>
                                <li>• Bisa dikirim ke seluruh Indonesia</li>
                                <li>• Kemasan aman dan rapi</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts->count() > 0)
    <div class="mb-12">
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Produk Terkait</h2>
                <p class="text-gray-600">Anda mungkin juga tertarik dengan produk ini</p>
            </div>
            <a href="{{ route('catalog.index') }}" class="text-indigo-600 hover:text-indigo-700 font-semibold flex items-center gap-2">
                Lihat Semua
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $product)
            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                <div class="relative overflow-hidden">
                    <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : 'https://via.placeholder.com/300x200' }}" 
                         alt="{{ $product->nama_alat }}" 
                         class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <button class="absolute top-3 right-3 w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 transition-all duration-300 opacity-0 group-hover:opacity-100">
                        <i class="far fa-heart text-sm"></i>
                    </button>
                </div>

                <div class="p-4">
                    <h3 class="text-base font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-indigo-600 transition-colors">
                        {{ $product->nama_alat }}
                    </h3>
                    <p class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}
                    </p>
                    <a href="{{ route('catalog.show', $product) }}" class="block text-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-2.5 rounded-xl hover:shadow-xl transform hover:scale-105 transition-all duration-300 font-semibold">
                        <i class="fas fa-eye mr-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
    function increaseQty() {
        const input = document.getElementById('quantity');
        const max = parseInt(input.max);
        const current = parseInt(input.value);
        if (current < max) {
            input.value = current + 1;
        }
    }

    function decreaseQty() {
        const input = document.getElementById('quantity');
        const min = parseInt(input.min);
        const current = parseInt(input.value);
        if (current > min) {
            input.value = current - 1;
        }
    }
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection