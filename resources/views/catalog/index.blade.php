@extends('layouts.app')

@section('title', 'Katalog Alat Musik')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header Section --}}
    <div class="text-center mb-12">
        <div class="inline-block mb-4">
            <span class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-sm font-semibold px-4 py-2 rounded-full">
                <i class="fas fa-store mr-2"></i>Koleksi Lengkap
            </span>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent mb-4">
            Katalog Alat Musik
        </h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Temukan berbagai pilihan alat musik tradisional Indonesia dengan kualitas terbaik
        </p>
    </div>

    {{-- Filter & Search --}}
    <div class="bg-white rounded-2xl shadow-xl p-6 mb-10 border border-gray-100">
        <form method="GET" action="{{ route('catalog.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                {{-- Search --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari alat musik..." 
                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300">
                </div>

                {{-- Filter Daerah --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-map-marker-alt text-gray-400"></i>
                    </div>
                    <select name="daerah_id" class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 appearance-none bg-white">
                        <option value="">Semua Daerah</option>
                        @foreach($daerahs as $daerah)
                            <option value="{{ $daerah->id }}" {{ request('daerah_id') == $daerah->id ? 'selected' : '' }}>
                                {{ $daerah->nama_daerah }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                    </div>
                </div>

                {{-- Filter Kategori --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-tag text-gray-400"></i>
                    </div>
                    <select name="kategori_id" class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 appearance-none bg-white">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                    </div>
                </div>

                {{-- Sort --}}
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-sort text-gray-400"></i>
                    </div>
                    <select name="sort" class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-300 appearance-none bg-white">
                        <option value="">Urutkan</option>
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center">
                    <i class="fas fa-search mr-2"></i> Cari Produk
                </button>
                <a href="{{ route('catalog.index') }}" class="bg-gray-100 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-300 flex items-center">
                    <i class="fas fa-redo mr-2"></i> Reset Filter
                </a>
            </div>
        </form>
    </div>

    {{-- Result Count --}}
    @if($alatMusiks->count() > 0)
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center gap-2">
                <div class="w-2 h-8 bg-gradient-to-b from-indigo-600 to-purple-600 rounded-full"></div>
                <p class="text-gray-700 font-medium">
                    Menampilkan <span class="font-bold text-indigo-600">{{ $alatMusiks->count() }}</span> dari 
                    <span class="font-bold text-indigo-600">{{ $alatMusiks->total() }}</span> produk
                </p>
            </div>
        </div>
    @endif

    {{-- Products Grid --}}
    @if($alatMusiks->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            @foreach($alatMusiks as $product)
            <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100">
                <div class="relative overflow-hidden">
                    <img src="{{ $product->gambar ? asset('storage/' . $product->gambar) : 'https://via.placeholder.com/400x300' }}" 
                         alt="{{ $product->nama_alat }}" 
                         class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    {{-- Stock Badge --}}
                    <div class="absolute top-4 left-4">
                        @if($product->stok > 0)
                            <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg flex items-center">
                                <i class="fas fa-check-circle mr-1"></i>Tersedia
                            </span>
                        @else
                            <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg flex items-center">
                                <i class="fas fa-times-circle mr-1"></i>Habis
                            </span>
                        @endif
                    </div>

                    {{-- Wishlist Button --}}
                    <button class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-white transition-all duration-300 opacity-0 group-hover:opacity-100 shadow-lg">
                        <i class="far fa-heart"></i>
                    </button>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-indigo-600 transition-colors duration-300">
                        {{ $product->nama_alat }}
                    </h3>
                    
                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-600">
                            <div class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-map-marker-alt text-blue-600 text-xs"></i>
                            </div>
                            <span class="truncate">{{ $product->daerah->nama_daerah }}</span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-600">
                            <div class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center mr-2">
                                <i class="fas fa-tag text-purple-600 text-xs"></i>
                            </div>
                            <span class="truncate">{{ $product->kategori->nama_kategori }}</span>
                        </div>
                    </div>
                    
                    <div class="flex items-end justify-between mb-4">
                        <div>
                            <p class="text-xs text-gray-500 mb-1">Harga</p>
                            <p class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">
                                Rp {{ number_format($product->harga, 0, ',', '.') }}
                            </p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 mb-1">Stok</p>
                            <p class="text-sm font-bold {{ $product->stok > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stok }} unit
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('catalog.show', $product) }}" 
                           class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-center py-3 rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center">
                            <i class="fas fa-eye mr-2"></i>Detail
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
                                        <i class="fas fa-ban"></i>
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

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $alatMusiks->links() }}
        </div>
    @else
        <div class="text-center py-20 bg-white rounded-2xl shadow-lg">
            <div class="inline-block p-8 bg-gray-100 rounded-full mb-6">
                <i class="fas fa-search text-6xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">Produk Tidak Ditemukan</h3>
            <p class="text-gray-600 mb-6">Maaf, tidak ada produk yang sesuai dengan pencarian Anda.</p>
            <a href="{{ route('catalog.index') }}" class="inline-block bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                <i class="fas fa-redo mr-2"></i>Reset Pencarian
            </a>
        </div>
    @endif
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection