@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden rounded-3xl mb-16">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 opacity-90"></div>
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"0.05\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="relative text-center py-24 px-4">
            <div class="inline-block mb-6">
                <div class="flex items-center justify-center space-x-2 bg-white/20 backdrop-blur-sm rounded-full px-6 py-2 text-white">
                    <i class="fas fa-star text-yellow-300"></i>
                    <span class="text-sm font-medium">Toko Alat Musik Terpercaya #1</span>
                </div>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Selamat Datang di<br>
                <span class="bg-gradient-to-r from-yellow-200 to-pink-200 bg-clip-text text-transparent">
                    Toko Alat Musik Nusantara
                </span>
            </h1>
            
            <p class="text-xl md:text-2xl text-white/90 mb-10 max-w-3xl mx-auto">
                Temukan berbagai alat musik tradisional Indonesia dengan kualitas terbaik dan harga terjangkau
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('catalog.index') }}" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-indigo-600 bg-white rounded-2xl overflow-hidden transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-th-large mr-3"></i>
                        Lihat Katalog
                        <i class="fas fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </a>
                
                <a href="#featured" class="group inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-white/20 backdrop-blur-sm border-2 border-white/50 rounded-2xl transition-all duration-300 hover:bg-white/30 hover:scale-105">
                    <i class="fas fa-chevron-down mr-3 group-hover:translate-y-1 transition-transform duration-300"></i>
                    Produk Unggulan
                </a>
            </div>
            
            <div class="mt-12 flex items-center justify-center gap-8 text-white/80">
                <div class="flex items-center gap-2">
                    <i class="fas fa-shield-alt text-2xl"></i>
                    <span class="text-sm">Garansi Resmi</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-shipping-fast text-2xl"></i>
                    <span class="text-sm">Gratis Ongkir</span>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fas fa-headset text-2xl"></i>
                    <span class="text-sm">24/7 Support</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Section --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-16">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform duration-300">
            <div class="flex items-center justify-between mb-3">
                <i class="fas fa-users text-3xl opacity-80"></i>
                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
            </div>
            <h3 class="text-3xl font-bold mb-1">1000+</h3>
            <p class="text-sm text-blue-100">Pelanggan Puas</p>
        </div>
        
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform duration-300">
            <div class="flex items-center justify-between mb-3">
                <i class="fas fa-boxes text-3xl opacity-80"></i>
                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
            </div>
            <h3 class="text-3xl font-bold mb-1">500+</h3>
            <p class="text-sm text-purple-100">Produk Tersedia</p>
        </div>
        
        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform duration-300">
            <div class="flex items-center justify-between mb-3">
                <i class="fas fa-store text-3xl opacity-80"></i>
                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
            </div>
            <h3 class="text-3xl font-bold mb-1">10+</h3>
            <p class="text-sm text-pink-100">Tahun Berpengalaman</p>
        </div>
        
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white transform hover:scale-105 transition-transform duration-300">
            <div class="flex items-center justify-between mb-3">
                <i class="fas fa-star text-3xl opacity-80"></i>
                <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
            </div>
            <h3 class="text-3xl font-bold mb-1">4.9</h3>
            <p class="text-sm text-orange-100">Rating Toko</p>
        </div>
    </div>

    {{-- Featured Products --}}
    <div id="featured" class="mb-16">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <span class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                    <i class="fas fa-fire mr-2"></i>Trending
                </span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Produk Unggulan</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Koleksi alat musik tradisional pilihan dengan kualitas terbaik
            </p>
        </div>

        @if(isset($featuredProducts) && count($featuredProducts) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProducts as $product)
            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <div class="relative overflow-hidden">
                    <img src="{{ $product->gambar ? Storage::url($product->gambar) : 'https://via.placeholder.com/400x300' }}" 
                         alt="{{ $product->nama_alat }}" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    <div class="absolute top-4 right-4">
                        <span class="bg-gradient-to-r from-yellow-400 to-orange-400 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                            <i class="fas fa-crown mr-1"></i>FEATURED
                        </span>
                    </div>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-start justify-between mb-3">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-indigo-600 transition-colors duration-300">
                            {{ $product->nama_alat }}
                        </h3>
                        <button class="text-gray-400 hover:text-red-500 transition-colors duration-300">
                            <i class="far fa-heart text-xl"></i>
                        </button>
                    </div>
                    
                    @if($product->deskripsi)
                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                        {{ Str::limit($product->deskripsi, 80) }}
                    </p>
                    @endif
                    
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <p class="text-sm text-gray-500 mb-1">Harga</p>
                            <p class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="flex items-center gap-1 bg-yellow-50 px-3 py-1 rounded-full">
                            <i class="fas fa-star text-yellow-500 text-sm"></i>
                            <span class="text-sm font-semibold text-gray-700">4.8</span>
                        </div>
                    </div>
                    
                    <div class="flex gap-3">
                        <a href="{{ route('catalog.show', $product) }}" 
                           class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center py-3 rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </a>
                        
                        @auth
                            @if(auth()->user()->isCustomer())
                                @if($product->stok > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="bg-gradient-to-r from-green-500 to-green-600 text-white px-4 py-3 rounded-xl hover:shadow-xl hover:from-green-600 hover:to-green-700 transform hover:scale-105 transition-all duration-300" title="Tambah ke Keranjang">
                                            <i class="fas fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                @else
                                    <button disabled class="bg-gray-300 text-gray-500 px-4 py-3 rounded-xl cursor-not-allowed" title="Stok Habis">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="bg-gray-100 text-gray-700 px-4 py-3 rounded-xl hover:bg-indigo-100 hover:text-indigo-600 transition-all duration-300" title="Login untuk Membeli">
                                <i class="fas fa-shopping-cart"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 bg-gray-50 rounded-2xl">
            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
            <p class="text-xl text-gray-500">Belum ada produk unggulan</p>
        </div>
        @endif
    </div>

    {{-- CTA Section --}}
    <div class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 rounded-3xl p-12 text-center text-white mb-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\"80\" height=\"80\" viewBox=\"0 0 80 80\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M0 0h40v40H0V0zm40 40h40v40H40V40zm0-40h2l-2 2V0zm0 4l4-4h2l-6 6V4zm0 4l8-8h2L40 10V8zm0 4L52 0h2L40 14v-2zm0 4L56 0h2L40 18v-2zm0 4L60 0h2L40 22v-2zm0 4L64 0h2L40 26v-2zm0 4L68 0h2L40 30v-2zm0 4L72 0h2L40 34v-2zm0 4L76 0h2L40 38v-2zm0 4L80 0v2L42 40h-2zm4 0L80 4v2L46 40h-2zm4 0L80 8v2L50 40h-2zm4 0l28-28v2L54 40h-2zm4 0l24-24v2L58 40h-2zm4 0l20-20v2L62 40h-2zm4 0l16-16v2L66 40h-2zm4 0l12-12v2L70 40h-2zm4 0l8-8v2l-6 6h-2zm4 0l4-4v2l-2 2h-2z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <div class="relative z-10">
            <i class="fas fa-gift text-5xl mb-6"></i>
            <h3 class="text-3xl md:text-4xl font-bold mb-4">Dapatkan Diskon Spesial!</h3>
            <p class="text-xl mb-8 text-white/90">Daftar sekarang dan dapatkan voucher diskon 20% untuk pembelian pertama</p>
            <a href="{{ route('register') }}" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-2xl font-bold text-lg hover:scale-105 transform transition-all duration-300 shadow-xl hover:shadow-2xl">
                <i class="fas fa-user-plus mr-2"></i>Daftar Sekarang
            </a>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-shield-alt text-3xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Garansi Resmi</h3>
            <p class="text-gray-600">Semua produk dilengkapi dengan garansi resmi dan jaminan kualitas terbaik</p>
        </div>
        
        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-shipping-fast text-3xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Pengiriman Cepat</h3>
            <p class="text-gray-600">Gratis ongkir ke seluruh Indonesia dengan pengiriman cepat dan aman</p>
        </div>
        
        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
            <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl flex items-center justify-center mb-6">
                <i class="fas fa-headset text-3xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Support 24/7</h3>
            <p class="text-gray-600">Tim customer service kami siap membantu Anda kapan saja</p>
        </div>
    </div>
</div>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection