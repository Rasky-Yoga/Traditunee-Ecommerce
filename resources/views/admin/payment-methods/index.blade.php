@extends('layouts.admin')

@section('header', 'Kelola Metode Pembayaran')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.payment-methods.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">
        <i class="fas fa-plus mr-2"></i> Tambah Metode Pembayaran
    </a>
</div>

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bank</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Rekening</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Atas Nama</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">QR Code</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($paymentMethods as $method)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $method->bank_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $method->account_number }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $method->account_name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    @if($method->qr_code)
                        <img src="{{ asset('storage/' . $method->qr_code) }}" alt="QR" class="h-12 w-12 object-contain">
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $method->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $method->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <a href="{{ route('admin.payment-methods.edit', $method) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('admin.payment-methods.destroy', $method) }}" method="POST" class="inline"
                          onsubmit="return confirm('Yakin ingin menghapus metode pembayaran ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada metode pembayaran</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $paymentMethods->links() }}
</div>
@endsection