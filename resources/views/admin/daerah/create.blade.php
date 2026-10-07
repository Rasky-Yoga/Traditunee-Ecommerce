{{-- resources/views/admin/daerah/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Daerah')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl shadow-xl p-8 mb-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.daerah.index') }}" 
               class="bg-white/20 hover:bg-white/30 text-white p-3 rounded-xl transition-all duration-200">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                    <i class="fas fa-plus-circle mr-3"></i>
                    Tambah Daerah Baru
                </h1>
                <p class="text-blue-100">Tambahkan data daerah asal alat musik tradisional</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <i class="fas fa-edit text-blue-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Form Tambah Daerah</h2>
                        <p class="text-sm text-gray-500">Lengkapi form di bawah ini</p>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <form action="{{ route('admin.daerah.store') }}" method="POST" class="p-6">
                @csrf

                {{-- Nama Daerah --}}
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                        Nama Daerah <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="nama_daerah" 
                           value="{{ old('nama_daerah') }}" 
                           required
                           placeholder="Contoh: Jawa Barat, Sumatera Utara"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all @error('nama_daerah') border-red-500 ring-2 ring-red-200 @enderror">
                    @error('nama_daerah')
                        <div class="mt-2 bg-red-50 border-l-4 border-red-500 p-3 rounded">
                            <p class="text-red-700 text-sm flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Masukkan nama daerah atau provinsi asal alat musik
                    </p>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-align-left text-blue-500 mr-2"></i>
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" 
                              rows="5"
                              placeholder="Masukkan deskripsi singkat tentang daerah ini..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none @error('deskripsi') border-red-500 ring-2 ring-red-200 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="mt-2 bg-red-50 border-l-4 border-red-500 p-3 rounded">
                            <p class="text-red-700 text-sm flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </p>
                        </div>
                    @enderror
                    <p class="mt-2 text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Opsional: Informasi tambahan tentang daerah
                    </p>
                </div>

                {{-- Divider --}}
                <div class="border-t border-gray-200 my-6"></div>

                {{-- Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" 
                            class="flex-1 sm:flex-initial bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-8 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-cyan-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i>
                        <span>Simpan Daerah</span>
                    </button>
                    <a href="{{ route('admin.daerah.index') }}" 
                       class="flex-1 sm:flex-initial bg-gray-100 text-gray-700 px-8 py-3 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-times"></i>
                        <span>Batal</span>
                    </a>
                </div>

                {{-- Info Box --}}
                <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                    <div class="flex items-start gap-3">
                        <div class="bg-blue-500 rounded-full p-2 mt-1">
                            <i class="fas fa-lightbulb text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-blue-800 font-semibold mb-1">Tips Pengisian</p>
                            <ul class="text-blue-700 text-sm space-y-1">
                                <li>• Gunakan nama daerah yang jelas dan mudah dipahami</li>
                                <li>• Deskripsi dapat berisi informasi budaya atau ciri khas daerah</li>
                                <li>• Pastikan nama daerah belum terdaftar sebelumnya</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Preview Card (Optional) --}}
<div class="max-w-3xl mx-auto mt-6">
    <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100">
        <div class="flex items-center gap-3 mb-3">
            <div class="bg-blue-500 rounded-full p-2">
                <i class="fas fa-eye text-white"></i>
            </div>
            <h3 class="font-bold text-gray-800">Preview</h3>
        </div>
        <p class="text-gray-600 text-sm">
            Data daerah yang Anda tambahkan akan muncul di halaman kelola daerah dan dapat digunakan sebagai referensi saat menambahkan alat musik baru.
        </p>
    </div>
</div>
@endsection