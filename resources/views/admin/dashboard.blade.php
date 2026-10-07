@extends('layouts.admin')

@section('header', 'Dashboard Admin')

@section('content')
{{-- Welcome Banner --}}
<div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 mb-8 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold mb-2">Selamat Datang Kembali! 👋</h1>
            <p class="text-indigo-100">Berikut adalah ringkasan bisnis Anda hari ini</p>
        </div>
        <div class="hidden md:block">
            <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-lg p-4">
                <p class="text-sm font-medium">{{ date('d F Y') }}</p>
            </div>
        </div>
    </div>
</div>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-indigo-500">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 p-3 rounded-xl shadow-lg">
                <i class="fas fa-guitar text-white text-2xl"></i>
            </div>
            <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-full">Produk</span>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total Produk</p>
            <p class="text-4xl font-bold text-gray-900 mb-1">{{ $totalProducts }}</p>
            <p class="text-xs text-gray-400">
                <i class="fas fa-box mr-1"></i>Item tersedia
            </p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-green-500">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-gradient-to-br from-green-500 to-green-600 p-3 rounded-xl shadow-lg">
                <i class="fas fa-receipt text-white text-2xl"></i>
            </div>
            <span class="text-xs font-semibold text-green-600 bg-green-50 px-3 py-1 rounded-full">Transaksi</span>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total Transaksi</p>
            <p class="text-4xl font-bold text-gray-900 mb-1">{{ $totalTransactions }}</p>
            <p class="text-xs text-gray-400">
                <i class="fas fa-chart-line mr-1"></i>Semua waktu
            </p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-blue-500">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-3 rounded-xl shadow-lg">
                <i class="fas fa-users text-white text-2xl"></i>
            </div>
            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">Customer</span>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total Customer</p>
            <p class="text-4xl font-bold text-gray-900 mb-1">{{ $totalCustomers }}</p>
            <p class="text-xs text-gray-400">
                <i class="fas fa-user-check mr-1"></i>Pengguna aktif
            </p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow duration-300 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between mb-4">
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 p-3 rounded-xl shadow-lg">
                <i class="fas fa-money-bill-wave text-white text-2xl"></i>
            </div>
            <span class="text-xs font-semibold text-yellow-600 bg-yellow-50 px-3 py-1 rounded-full">Revenue</span>
        </div>
        <div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total Revenue</p>
            <p class="text-3xl font-bold text-gray-900 mb-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400">
                <i class="fas fa-trending-up mr-1"></i>Pendapatan kotor
            </p>
        </div>
    </div>
</div>

{{-- Main Content Grid --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Recent Transactions --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-clock mr-2"></i>
                        Transaksi Terbaru
                    </h2>
                    <p class="text-indigo-100 text-sm mt-1">5 transaksi terakhir</p>
                </div>
                <div class="bg-white bg-opacity-20 backdrop-blur-sm p-3 rounded-lg">
                    <i class="fas fa-chart-bar text-white text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            @if($recentTransactions->count() > 0)
                <div class="space-y-4">
                    @foreach($recentTransactions as $transaction)
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="bg-indigo-100 p-3 rounded-lg">
                                <i class="fas fa-file-invoice text-indigo-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $transaction->transaction_code }}</p>
                                <p class="text-sm text-gray-500 flex items-center mt-1">
                                    <i class="fas fa-user text-xs mr-1"></i>
                                    {{ $transaction->user->name }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-indigo-600 mb-2">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                            <span class="text-xs px-3 py-1 rounded-full font-semibold
                                @if($transaction->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($transaction->status == 'completed') bg-green-100 text-green-700
                                @else bg-blue-100 text-blue-700
                                @endif">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.transactions.index') }}" class="flex items-center justify-center mt-6 text-indigo-600 hover:text-indigo-700 font-semibold hover:bg-indigo-50 py-3 rounded-lg transition-colors duration-200">
                    Lihat Semua Transaksi
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @else
                <div class="text-center py-12">
                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                    </div>
                    <p class="text-gray-500 font-medium">Belum ada transaksi</p>
                    <p class="text-gray-400 text-sm mt-1">Transaksi akan muncul di sini</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Low Stock Products --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-orange-500 to-red-500 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Stok Rendah
                    </h2>
                    <p class="text-orange-100 text-sm mt-1">Produk dengan stok ≤ 5</p>
                </div>
                <div class="bg-white bg-opacity-20 backdrop-blur-sm p-3 rounded-lg">
                    <i class="fas fa-box-open text-white text-xl"></i>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            @if($lowStockProducts->count() > 0)
                <div class="space-y-4">
                    @foreach($lowStockProducts as $product)
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                        <div class="flex items-center space-x-4">
                            <div class="bg-orange-100 p-3 rounded-lg">
                                <i class="fas fa-guitar text-orange-600"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $product->nama_alat }}</p>
                                <p class="text-sm text-gray-500 flex items-center mt-1">
                                    <i class="fas fa-map-marker-alt text-xs mr-1"></i>
                                    {{ $product->daerah->nama_daerah }}
                                </p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center
                                {{ $product->stok == 0 ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700' }}">
                                <i class="fas fa-cube mr-1"></i>
                                Stok: {{ $product->stok }}
                            </span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('admin.alat-musik.index') }}" class="flex items-center justify-center mt-6 text-orange-600 hover:text-orange-700 font-semibold hover:bg-orange-50 py-3 rounded-lg transition-colors duration-200">
                    Kelola Produk
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            @else
                <div class="text-center py-12">
                    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                    </div>
                    <p class="text-gray-700 font-medium">Semua Stok Aman! 🎉</p>
                    <p class="text-gray-500 text-sm mt-1">Semua produk memiliki stok cukup</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection