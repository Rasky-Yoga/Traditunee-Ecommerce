@extends('layouts.admin')

@section('header', 'Tambah Metode Pembayaran')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <form action="{{ route('admin.payment-methods.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Bank <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="bank_name" 
                       id="bank_name" 
                       value="{{ old('bank_name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('bank_name') border-red-500 @enderror"
                       required>
                @error('bank_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">
                    Nomor Rekening <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="account_number" 
                       id="account_number" 
                       value="{{ old('account_number') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('account_number') border-red-500 @enderror"
                       required>
                @error('account_number')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="account_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Atas Nama <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="account_name" 
                       id="account_name" 
                       value="{{ old('account_name') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('account_name') border-red-500 @enderror"
                       required>
                @error('account_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="qr_code" class="block text-sm font-medium text-gray-700 mb-2">
                    QR Code (Opsional)
                </label>
                <input type="file" 
                       name="qr_code" 
                       id="qr_code" 
                       accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('qr_code') border-red-500 @enderror">
                <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, atau GIF. Maksimal 2MB.</p>
                @error('qr_code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           value="1" 
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <span class="ml-2 text-sm text-gray-700">Aktifkan metode pembayaran</span>
                </label>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <a href="{{ route('admin.payment-methods.index') }}" 
                   class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection