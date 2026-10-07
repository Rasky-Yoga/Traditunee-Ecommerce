{{-- resources/views/admin/transactions/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl shadow-xl p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                    <i class="fas fa-file-invoice mr-3"></i>
                    Detail Transaksi
                </h1>
                <p class="text-purple-100">Informasi lengkap transaksi pelanggan</p>
            </div>
            <a href="{{ route('admin.transactions.index') }}" 
               class="bg-white text-purple-600 px-6 py-3 rounded-xl font-semibold hover:bg-purple-50 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-6 shadow-md animate-fade-in">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="bg-green-500 rounded-full p-2">
                        <i class="fas fa-check text-white"></i>
                    </div>
                    <div>
                        <p class="text-green-800 font-semibold">Berhasil!</p>
                        <p class="text-green-700 text-sm">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="text-green-500 hover:text-green-700" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Transaction Header Info --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <i class="fas fa-receipt text-purple-600"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Informasi Transaksi</h2>
                            <p class="text-sm text-gray-500">Kode: {{ $transaction->transaction_code }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-6">
                        <div class="flex items-start gap-4">
                            <div class="bg-gradient-to-br from-indigo-100 to-purple-100 w-14 h-14 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fas fa-hashtag text-indigo-600 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Kode Transaksi</p>
                                <p class="text-xl font-bold text-gray-900">{{ $transaction->transaction_code }}</p>
                                <p class="text-sm text-gray-500 flex items-center gap-1 mt-1">
                                    <i class="fas fa-calendar-alt"></i>
                                    {{ $transaction->created_at->format('d M Y, H:i') }} WIB
                                </p>
                            </div>
                        </div>
                        
                        <span class="px-5 py-3 rounded-xl text-sm font-bold shadow-lg flex items-center gap-2
                            @if($transaction->status == 'pending') bg-yellow-100 text-yellow-800 border border-yellow-200
                            @elseif($transaction->status == 'confirmed') bg-green-100 text-green-800 border border-green-200
                            @elseif($transaction->status == 'shipped') bg-indigo-100 text-indigo-800 border border-indigo-200
                            @elseif($transaction->status == 'completed') bg-blue-100 text-blue-800 border border-blue-200
                            @elseif($transaction->status == 'cancelled') bg-red-100 text-red-800 border border-red-200
                            @endif">
                            @if($transaction->status == 'pending')
                                <i class="fas fa-clock"></i>
                                Menunggu Konfirmasi
                            @elseif($transaction->status == 'confirmed')
                                <i class="fas fa-check-circle"></i>
                                Dikonfirmasi
                            @elseif($transaction->status == 'shipped')
                                <i class="fas fa-shipping-fast"></i>
                                Sedang Dikirim
                            @elseif($transaction->status == 'completed')
                                <i class="fas fa-check-double"></i>
                                Selesai
                            @elseif($transaction->status == 'cancelled')
                                <i class="fas fa-times-circle"></i>
                                Dibatalkan
                            @endif
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-4 border border-blue-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-blue-500 rounded-lg p-2">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <p class="text-sm font-bold text-gray-700">Informasi Customer</p>
                            </div>
                            <p class="font-bold text-gray-900 text-lg mb-1">{{ $transaction->user->name }}</p>
                            <p class="text-sm text-gray-600 flex items-center gap-2">
                                <i class="fas fa-envelope"></i>
                                {{ $transaction->user->email }}
                            </p>
                        </div>

                        <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl p-4 border border-green-100">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="bg-green-500 rounded-lg p-2">
                                    <i class="fas fa-money-bill-wave text-white"></i>
                                </div>
                                <p class="text-sm font-bold text-gray-700">Total Pembayaran</p>
                            </div>
                            <p class="text-3xl font-bold text-green-600">
                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Shipping Information --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-orange-100 p-2 rounded-lg">
                            <i class="fas fa-shipping-fast text-orange-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Informasi Pengiriman</h3>
                            <p class="text-sm text-gray-500">Alamat tujuan pengiriman</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="bg-gradient-to-br from-orange-50 to-amber-50 rounded-xl p-5 border border-orange-200">
                        <div class="flex items-start gap-3">
                            <div class="bg-orange-500 rounded-lg p-2 mt-1">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-gray-900 text-lg mb-2">{{ $transaction->recipient_name }}</p>
                                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $transaction->deliver_to }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-indigo-100 p-2 rounded-lg">
                            <i class="fas fa-shopping-bag text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Detail Pesanan</h3>
                            <p class="text-sm text-gray-500">{{ $transaction->transactionDetails->count() }} item produk</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($transaction->transactionDetails as $detail)
                        <div class="flex gap-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl p-4 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                            <div class="relative">
                                <img src="{{ $detail->alatMusik->gambar ? asset('storage/' . $detail->alatMusik->gambar) : 'https://via.placeholder.com/80' }}" 
                                     alt="{{ $detail->alatMusik->nama_alat }}" 
                                     class="w-24 h-24 object-cover rounded-lg shadow-md">
                                <div class="absolute -top-2 -right-2 bg-indigo-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-xs font-bold shadow-lg">
                                    {{ $detail->quantity }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $detail->alatMusik->nama_alat }}</h4>
                                <div class="flex items-center gap-2 text-sm text-gray-600 mb-2">
                                    <i class="fas fa-map-marker-alt text-indigo-500"></i>
                                    <span>{{ $detail->alatMusik->daerah->nama_daerah }}</span>
                                </div>
                                <div class="flex items-center gap-3 text-sm">
                                    <span class="bg-white px-3 py-1 rounded-lg font-medium text-gray-700 border border-gray-300">
                                        Qty: {{ $detail->quantity }}
                                    </span>
                                    <span class="text-gray-600">×</span>
                                    <span class="bg-indigo-100 px-3 py-1 rounded-lg font-bold text-indigo-700">
                                        Rp {{ number_format($detail->price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="text-right flex flex-col justify-center">
                                <p class="text-sm text-gray-600 mb-1">Subtotal</p>
                                <p class="text-xl font-bold text-indigo-600">
                                    Rp {{ number_format($detail->quantity * $detail->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Total Summary --}}
                    <div class="mt-6 pt-6 border-t-2 border-gray-200">
                        <div class="flex justify-between items-center bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-5 border border-indigo-200">
                            <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-indigo-600">
                                Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Payment Proof --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <i class="fas fa-image text-green-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Bukti Pembayaran</h3>
                            <p class="text-sm text-gray-500">Upload dari customer</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    @if($transaction->payment_proof)
                        <div class="group relative">
                            <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                                 alt="Bukti Pembayaran" 
                                 class="w-full rounded-xl border-2 border-gray-200 cursor-pointer hover:border-green-500 transition-all duration-200 shadow-lg hover:shadow-2xl"
                                 onclick="window.open('{{ asset('storage/' . $transaction->payment_proof) }}', '_blank')">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-xl transition-all duration-200 flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-200"></i>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600 text-center mt-3 flex items-center justify-center gap-2">
                            <i class="fas fa-info-circle text-blue-500"></i>
                            Klik gambar untuk memperbesar
                        </p>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-300">
                            <i class="fas fa-image text-gray-300 text-6xl mb-4"></i>
                            <p class="text-gray-500 font-medium">Belum ada bukti pembayaran</p>
                            <p class="text-gray-400 text-sm mt-1">Customer belum upload bukti</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Status Actions for Pending --}}
            @if($transaction->payment_proof && $transaction->status == 'pending')
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-yellow-100 p-2 rounded-lg">
                            <i class="fas fa-tasks text-yellow-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Ubah Status</h3>
                            <p class="text-sm text-gray-500">Konfirmasi atau tolak pembayaran</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <form action="{{ route('admin.transactions.updateStatus', $transaction) }}" method="POST" class="space-y-3">
                        @csrf
                        @method('PUT')
                        
                        <button type="submit" name="status" value="confirmed" 
                                class="w-full bg-gradient-to-r from-green-600 to-emerald-600 text-white py-4 rounded-xl hover:from-green-700 hover:to-emerald-700 font-bold shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2"
                                onclick="return confirm('✅ Konfirmasi pembayaran ini?\n\nPastikan bukti pembayaran sudah sesuai.')">
                            <i class="fas fa-check-circle text-xl"></i>
                            <span>Konfirmasi Pembayaran</span>
                        </button>
                        
                        <button type="submit" name="status" value="cancelled" 
                                class="w-full bg-gradient-to-r from-red-600 to-rose-600 text-white py-4 rounded-xl hover:from-red-700 hover:to-rose-700 font-bold shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2"
                                onclick="return confirm('❌ Tolak pembayaran ini?\n\nTransaksi akan dibatalkan dan tidak dapat dikembalikan.')">
                            <i class="fas fa-times-circle text-xl"></i>
                            <span>Tolak Pembayaran</span>
                        </button>
                    </form>
                </div>
            </div>
            @endif

            {{-- Status Actions for Confirmed - Kirim Pesanan --}}
            @if($transaction->status == 'confirmed')
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-indigo-100 p-2 rounded-lg">
                            <i class="fas fa-shipping-fast text-indigo-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Pengiriman</h3>
                            <p class="text-sm text-gray-500">Kirim pesanan ke customer</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="bg-green-50 rounded-xl p-4 mb-4 border border-green-200">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-600 mt-1"></i>
                            <div>
                                <p class="text-sm text-green-900 font-medium mb-1">Pembayaran Terkonfirmasi</p>
                                <p class="text-xs text-green-700">Pesanan siap untuk dikirim ke customer</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.transactions.updateStatus', $transaction) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <button type="submit" name="status" value="shipped" 
                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-xl hover:from-indigo-700 hover:to-purple-700 font-bold shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2"
                                onclick="return confirm('📦 Kirim pesanan ini?\n\nPastikan pesanan sudah siap untuk dikirim.')">
                            <i class="fas fa-truck text-xl"></i>
                            <span>Kirim Pesanan</span>
                        </button>
                    </form>
                </div>
            </div>
            @endif

            {{-- Status Actions for Shipped - Pesanan Selesai --}}
            @if($transaction->status == 'shipped')
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fas fa-check-double text-blue-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Selesaikan Pesanan</h3>
                            <p class="text-sm text-gray-500">Tandai pesanan diterima</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="bg-indigo-50 rounded-xl p-4 mb-4 border border-indigo-200">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-shipping-fast text-indigo-600 mt-1"></i>
                            <div>
                                <p class="text-sm text-indigo-900 font-medium mb-1">Sedang Dikirim</p>
                                <p class="text-xs text-indigo-700">Pesanan dalam perjalanan ke customer</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.transactions.updateStatus', $transaction) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <button type="submit" name="status" value="completed" 
                                class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 text-white py-4 rounded-xl hover:from-blue-700 hover:to-cyan-700 font-bold shadow-lg hover:shadow-xl transition-all duration-200 flex items-center justify-center gap-2"
                                onclick="return confirm('✅ Tandai pesanan ini sebagai selesai?\n\nPastikan customer sudah menerima pesanan.')">
                            <i class="fas fa-check-double text-xl"></i>
                            <span>Pesanan Selesai</span>
                        </button>
                    </form>
                </div>
            </div>
            @endif

            {{-- Transaction Timeline --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <i class="fas fa-history text-purple-600"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Timeline</h3>
                            <p class="text-sm text-gray-500">Riwayat transaksi</p>
                        </div>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        {{-- Transaksi Dibuat --}}
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="bg-indigo-500 rounded-full p-2">
                                    <i class="fas fa-plus text-white text-xs"></i>
                                </div>
                                @if($transaction->status != 'pending' && $transaction->status != 'cancelled')
                                <div class="w-0.5 h-12 bg-indigo-200"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-4">
                                <p class="font-semibold text-gray-900">Transaksi Dibuat</p>
                                <p class="text-sm text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        {{-- Pembayaran Dikonfirmasi --}}
                        @if(in_array($transaction->status, ['confirmed', 'shipped', 'completed']))
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="bg-green-500 rounded-full p-2">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                @if(in_array($transaction->status, ['shipped', 'completed']))
                                <div class="w-0.5 h-12 bg-green-200"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-4">
                                <p class="font-semibold text-gray-900">Pembayaran Dikonfirmasi</p>
                                <p class="text-sm text-gray-500">{{ $transaction->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif

                        {{-- Sedang Dikirim --}}
                        @if(in_array($transaction->status, ['shipped', 'completed']))
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="bg-indigo-500 rounded-full p-2">
                                    <i class="fas fa-shipping-fast text-white text-xs"></i>
                                </div>
                                @if($transaction->status == 'completed')
                                <div class="w-0.5 h-12 bg-indigo-200"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-4">
                                <p class="font-semibold text-gray-900">Sedang Dikirim</p>
                                <p class="text-sm text-gray-500">{{ $transaction->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif

                        {{-- Pesanan Selesai --}}
                        @if($transaction->status == 'completed')
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="bg-blue-500 rounded-full p-2">
                                    <i class="fas fa-check-double text-white text-xs"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Pesanan Selesai</p>
                                <p class="text-sm text-gray-500">{{ $transaction->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif

                        {{-- Transaksi Dibatalkan --}}
                        @if($transaction->status == 'cancelled')
                        <div class="flex gap-3">
                            <div class="flex flex-col items-center">
                                <div class="bg-red-500 rounded-full p-2">
                                    <i class="fas fa-times text-white text-xs"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Transaksi Dibatalkan</p>
                                <p class="text-sm text-gray-500">{{ $transaction->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Custom CSS for Animation --}}
<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}
</style>

@endsection
