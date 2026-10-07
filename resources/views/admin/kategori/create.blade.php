{{-- resources/views/admin/kategori/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 rounded-2xl shadow-xl p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                    <i class="fas fa-plus-circle mr-3"></i>
                    Tambah Kategori
                </h1>
                <p class="text-purple-100">Tambahkan kategori baru untuk alat musik tradisional</p>
            </div>
            <a href="{{ route('admin.kategori.index') }}" 
               class="bg-white text-purple-600 px-6 py-3 rounded-xl font-semibold hover:bg-purple-50 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6 shadow-md animate-fade-in">
            <div class="flex items-start gap-3">
                <div class="bg-red-500 rounded-full p-2 mt-1">
                    <i class="fas fa-exclamation text-white"></i>
                </div>
                <div class="flex-1">
                    <p class="text-red-800 font-semibold mb-2">Terdapat kesalahan pada input:</p>
                    <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="text-red-500 hover:text-red-700" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
    @endif

    {{-- Main Form Card --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex items-center gap-3">
                <div class="bg-purple-100 p-2 rounded-lg">
                    <i class="fas fa-tag text-purple-600"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Form Tambah Kategori</h2>
                    <p class="text-sm text-gray-500">Lengkapi form di bawah untuk menambahkan kategori baru</p>
                </div>
            </div>
        </div>

        {{-- Form Section --}}
        <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-6">
            @csrf

            <div class="grid grid-cols-1 gap-6">
                {{-- Nama Kategori --}}
                <div class="space-y-2">
                    <label for="nama_kategori" class="block text-sm font-bold text-gray-700">
                        Nama Kategori <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fas fa-tag text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="nama_kategori" 
                               id="nama_kategori"
                               value="{{ old('nama_kategori') }}"
                               class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 @error('nama_kategori') border-red-500 @enderror"
                               placeholder="Contoh: Alat Musik Petik"
                               required>
                    </div>
                    @error('nama_kategori')
                        <p class="text-red-500 text-sm flex items-center gap-1 mt-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="text-gray-500 text-xs flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        Masukkan nama kategori yang jelas dan deskriptif
                    </p>
                </div>

                {{-- Deskripsi --}}
                <div class="space-y-2">
                    <label for="deskripsi" class="block text-sm font-bold text-gray-700">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3 left-4 pointer-events-none">
                            <i class="fas fa-align-left text-gray-400"></i>
                        </div>
                        <textarea name="deskripsi" 
                                  id="deskripsi"
                                  rows="5"
                                  class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-200 resize-none @error('deskripsi') border-red-500 @enderror"
                                  placeholder="Jelaskan karakteristik dan informasi penting tentang kategori ini..."
                                  required>{{ old('deskripsi') }}</textarea>
                    </div>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm flex items-center gap-1 mt-1">
                            <i class="fas fa-exclamation-circle"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="text-gray-500 text-xs flex items-center gap-1">
                        <i class="fas fa-info-circle"></i>
                        Berikan deskripsi lengkap tentang kategori ini (minimal 10 karakter)
                    </p>
                </div>

                {{-- Info Tips --}}
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fas fa-lightbulb text-blue-600"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-blue-900 mb-2">Tips Menambahkan Kategori</h3>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-blue-600 mt-0.5"></i>
                                    <span>Gunakan nama kategori yang unik dan mudah dikenali</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-blue-600 mt-0.5"></i>
                                    <span>Deskripsi yang baik membantu pengguna memahami jenis alat musik dalam kategori</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check-circle text-blue-600 mt-0.5"></i>
                                    <span>Pastikan nama kategori tidak duplikat dengan yang sudah ada</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-200">
                <button type="submit"
                        class="flex-1 sm:flex-none bg-gradient-to-r from-purple-600 to-pink-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-purple-700 hover:to-pink-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                    <i class="fas fa-save"></i>
                    <span>Simpan Kategori</span>
                </button>
                
                <a href="{{ route('admin.kategori.index') }}"
                   class="flex-1 sm:flex-none bg-gray-100 text-gray-700 px-8 py-3 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center justify-center gap-2">
                    <i class="fas fa-times"></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
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