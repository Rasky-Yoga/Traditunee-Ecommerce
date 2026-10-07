{{-- resources/views/admin/transactions/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Transaksi')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl shadow-xl p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                    <i class="fas fa-receipt mr-3"></i>
                    Kelola Transaksi
                </h1>
                <p class="text-purple-100">Kelola dan monitor semua transaksi pelanggan</p>
            </div>
            <div class="flex items-center gap-3 bg-white/20 backdrop-blur-sm rounded-xl px-4 py-3">
                <i class="fas fa-chart-line text-white text-2xl"></i>
                <div>
                    <p class="text-purple-100 text-xs">Total Transaksi</p>
                    <p class="text-white text-xl font-bold">{{ $transactions->total() }}</p>
                </div>
            </div>
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

    {{-- Filter Section --}}
    <div class="bg-white rounded-xl shadow-lg p-4 mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <i class="fas fa-filter text-purple-600"></i>
                <span class="font-semibold text-gray-700">Filter Status:</span>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.transactions.index') }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ !request('status') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-list mr-1"></i> Semua
                </a>
                <a href="{{ route('admin.transactions.index', ['status' => 'pending']) }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ request('status') == 'pending' ? 'bg-yellow-500 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-clock mr-1"></i> Pending
                </a>
                <a href="{{ route('admin.transactions.index', ['status' => 'confirmed']) }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ request('status') == 'confirmed' ? 'bg-green-500 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-check-circle mr-1"></i> Confirmed
                </a>
                <a href="{{ route('admin.transactions.index', ['status' => 'completed']) }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ request('status') == 'completed' ? 'bg-blue-500 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-check-double mr-1"></i> Completed
                </a>
                <a href="{{ route('admin.transactions.index', ['status' => 'cancelled']) }}" 
                   class="px-4 py-2 rounded-lg font-medium transition-all duration-200 {{ request('status') == 'cancelled' ? 'bg-red-500 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    <i class="fas fa-times-circle mr-1"></i> Cancelled
                </a>
            </div>
        </div>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-100 p-2 rounded-lg">
                        <i class="fas fa-shopping-cart text-purple-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Data Transaksi</h2>
                        <p class="text-sm text-gray-500">
                            @if(request('status'))
                                Status: <span class="font-semibold">{{ ucfirst(request('status')) }}</span> - 
                            @endif
                            Total: {{ $transactions->total() }} transaksi
                        </p>
                    </div>
                </div>
                
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700">
                        <i class="fas fa-download mr-2"></i>Export
                    </button>
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700">
                        <i class="fas fa-print mr-2"></i>Print
                    </button>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        @if($transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b-2 border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kode Transaksi</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Customer</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Bukti Bayar</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <div class="bg-gradient-to-br from-indigo-100 to-purple-100 w-10 h-10 rounded-lg flex items-center justify-center shadow-sm">
                                        <i class="fas fa-hashtag text-indigo-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $transaction->transaction_code }}</p>
                                        <p class="text-xs text-gray-500">ID: #{{ $transaction->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-gradient-to-br from-blue-100 to-cyan-100 w-10 h-10 rounded-full flex items-center justify-center shadow-sm">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $transaction->user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $transaction->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-money-bill-wave text-green-500"></i>
                                    <span class="text-sm font-bold text-indigo-600">
                                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($transaction->payment_proof)
                                    <button onclick="showProofModal('{{ asset('storage/' . $transaction->payment_proof) }}')" 
                                            class="inline-flex flex-col items-center gap-1 p-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-all duration-200 group">
                                        <i class="fas fa-image text-xl group-hover:scale-110 transition-transform"></i>
                                        <span class="text-xs font-medium">Lihat Bukti</span>
                                    </button>
                                @else
                                    <div class="inline-flex flex-col items-center gap-1 text-gray-400">
                                        <i class="fas fa-image-slash text-xl"></i>
                                        <span class="text-xs">Belum Upload</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-4 py-2 inline-flex items-center gap-2 text-xs font-bold rounded-full shadow-sm
                                    @if($transaction->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($transaction->status == 'confirmed') bg-green-100 text-green-800
                                    @elseif($transaction->status == 'completed') bg-blue-100 text-blue-800
                                    @elseif($transaction->status == 'cancelled') bg-red-100 text-red-800
                                    @endif">
                                    @if($transaction->status == 'pending')
                                        <i class="fas fa-clock"></i>
                                    @elseif($transaction->status == 'confirmed')
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($transaction->status == 'completed')
                                        <i class="fas fa-check-double"></i>
                                    @elseif($transaction->status == 'cancelled')
                                        <i class="fas fa-times-circle"></i>
                                    @endif
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm text-gray-700">
                                    <i class="fas fa-calendar-alt text-gray-400"></i>
                                    <div>
                                        <p class="font-medium">{{ $transaction->created_at->format('d M Y') }}</p>
                                        <p class="text-xs text-gray-500">{{ $transaction->created_at->format('H:i') }} WIB</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.transactions.show', $transaction) }}" 
                                   class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-all duration-200 font-medium group">
                                    <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                                    <span>Detail</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($transactions->hasPages())
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold text-gray-900">{{ $transactions->firstItem() }}</span> 
                        sampai <span class="font-semibold text-gray-900">{{ $transactions->lastItem() }}</span> 
                        dari <span class="font-semibold text-gray-900">{{ $transactions->total() }}</span> data
                    </div>
                    <div>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
            @endif
        @else
            <div class="px-6 py-16">
                <div class="text-center">
                    <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-gray-400 text-5xl"></i>
                    </div>
                    <p class="text-gray-600 font-semibold text-lg mb-2">Tidak ada transaksi</p>
                    <p class="text-gray-400 text-sm">
                        @if(request('status'))
                            Tidak ada transaksi dengan status "{{ ucfirst(request('status')) }}"
                        @else
                            Belum ada transaksi yang masuk
                        @endif
                    </p>
                </div>
            </div>
        @endif
    </div>
</div>

{{-- Modal Bukti Bayar --}}
<div id="proofModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 animate-fade-in" onclick="closeProofModal()">
    <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full overflow-hidden" onclick="event.stopPropagation()">
        <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl font-bold text-white flex items-center gap-2">
                <i class="fas fa-image"></i>
                Bukti Pembayaran
            </h3>
            <button onclick="closeProofModal()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        <div class="p-6 bg-gray-50">
            <div class="bg-white rounded-xl shadow-lg p-4">
                <img id="proofImage" src="" alt="Bukti Pembayaran" class="w-full rounded-lg">
            </div>
        </div>
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <button onclick="closeProofModal()" 
                    class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl">
                Tutup
            </button>
        </div>
    </div>
</div>

{{-- Custom CSS & Scripts --}}
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

<script>
function showProofModal(imageSrc) {
    document.getElementById('proofImage').src = imageSrc;
    document.getElementById('proofModal').classList.remove('hidden');
}

function closeProofModal() {
    document.getElementById('proofModal').classList.add('hidden');
}

// Close modal on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProofModal();
    }
});
</script>
@endsection