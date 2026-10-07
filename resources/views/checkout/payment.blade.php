@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-8">Pembayaran</h1>

    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-yellow-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-yellow-700">
                    <strong>Penting:</strong> Silakan lakukan pembayaran sesuai total yang tertera dan upload bukti transfer Anda.
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- Order Summary --}}
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Detail Pesanan</h2>
            
            <div class="space-y-3 mb-6">
                <div class="flex justify-between text-gray-600">
                    <span>Kode Transaksi:</span>
                    <span class="font-semibold">{{ $transaction->transaction_code }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Penerima:</span>
                    <span>{{ $transaction->recipient_name }}</span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Alamat:</span>
                    <span class="text-right">{{ $transaction->deliver_to }}</span>
                </div>
                <hr class="my-4">
                <div class="flex justify-between items-center">
                    <span class="text-lg font-semibold text-gray-900">Total Pembayaran:</span>
                    <span class="text-3xl font-bold text-indigo-600">
                        Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <div class="bg-gray-50 rounded-lg p-4">
                <p class="text-sm text-gray-600 mb-2"><strong>Status:</strong></p>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($transaction->status == 'pending') bg-yellow-100 text-yellow-800
                    @elseif($transaction->status == 'confirmed') bg-green-100 text-green-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    @if($transaction->status == 'pending' && !$transaction->payment_proof)
                        Menunggu Pembayaran
                    @elseif($transaction->status == 'pending' && $transaction->payment_proof)
                        Menunggu Konfirmasi Admin
                    @else
                        {{ ucfirst($transaction->status) }}
                    @endif
                </span>
            </div>
        </div>

        {{-- Payment Methods & Upload --}}
        <div class="space-y-6">
            {{-- Payment Methods --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Metode Pembayaran</h2>
                
                @if($paymentMethods->count() > 0)
                    <div class="space-y-4">
                        @foreach($paymentMethods as $method)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-indigo-500 transition">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $method->bank_name }}</h3>
                                    <p class="text-gray-600 text-sm mb-1">
                                        <strong>No. Rekening:</strong> {{ $method->account_number }}
                                    </p>
                                    <p class="text-gray-600 text-sm">
                                        <strong>Atas Nama:</strong> {{ $method->account_name }}
                                    </p>
                                </div>
                                @if($method->qr_code)
                                <div class="ml-4">
                                    <img src="{{ asset('storage/' . $method->qr_code) }}" 
                                         alt="QR Code {{ $method->bank_name }}" 
                                         class="w-24 h-24 object-contain border rounded cursor-pointer"
                                         onclick="showQRModal('{{ asset('storage/' . $method->qr_code) }}', '{{ $method->bank_name }}')">
                                    <p class="text-xs text-center text-gray-500 mt-1">Klik untuk perbesar</p>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-600 text-center py-4">Belum ada metode pembayaran tersedia</p>
                @endif
            </div>

            {{-- Upload Payment Proof --}}
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Upload Bukti Transfer</h2>
                
                @if($transaction->payment_proof)
                    <div class="mb-6">
                        <p class="text-sm text-gray-600 mb-2">Bukti transfer yang sudah diupload:</p>
                        <img src="{{ asset('storage/' . $transaction->payment_proof) }}" 
                             alt="Bukti Transfer" 
                             class="w-full h-64 object-contain border rounded-lg mb-4">
                        
                        @if($transaction->status == 'pending')
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-sm text-yellow-800">
                                    <i class="fas fa-clock mr-2"></i>
                                    Bukti transfer Anda sedang diverifikasi oleh admin. Mohon tunggu konfirmasi.
                                </p>
                            </div>
                        @elseif($transaction->status == 'confirmed')
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <p class="text-sm text-green-800">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Pembayaran Anda telah dikonfirmasi! Pesanan sedang diproses.
                                </p>
                            </div>
                        @endif
                    </div>
                @endif

                @if(!$transaction->payment_proof || $transaction->status == 'pending')
                <form action="{{ route('payment.upload', $transaction) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">
                            {{ $transaction->payment_proof ? 'Upload Ulang Bukti Transfer' : 'Pilih File Bukti Transfer' }} *
                        </label>
                        <input type="file" name="payment_proof" accept="image/*" required
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-600 @error('payment_proof') border-red-500 @enderror">
                        @error('payment_proof')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-2">Format: JPG, PNG, JPEG. Max: 2MB</p>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 font-semibold">
                        <i class="fas fa-upload mr-2"></i> 
                        {{ $transaction->payment_proof ? 'Upload Ulang' : 'Upload Bukti Transfer' }}
                    </button>
                </form>
                @endif

                <div class="mt-6">
                    <a href="{{ route('transactions.show', $transaction) }}" class="block text-center bg-gray-200 text-gray-700 py-3 rounded-lg hover:bg-gray-300">
                        Lihat Detail Transaksi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- QR Code Modal --}}
<div id="qrModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4" onclick="closeQRModal()">
    <div class="bg-white rounded-lg p-6 max-w-md w-full" onclick="event.stopPropagation()">
        <div class="flex justify-between items-center mb-4">
            <h3 id="qrModalTitle" class="text-xl font-bold text-gray-900"></h3>
            <button onclick="closeQRModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        <img id="qrModalImage" src="" alt="QR Code" class="w-full">
    </div>
</div>

<script>
function showQRModal(imageSrc, bankName) {
    document.getElementById('qrModalImage').src = imageSrc;
    document.getElementById('qrModalTitle').textContent = 'QR Code ' + bankName;
    document.getElementById('qrModal').classList.remove('hidden');
}

function closeQRModal() {
    document.getElementById('qrModal').classList.add('hidden');
}
</script>
@endsection