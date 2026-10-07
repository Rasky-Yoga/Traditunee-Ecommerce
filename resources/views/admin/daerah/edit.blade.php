{{-- resources/views/admin/daerah/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Daerah')

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
                    <i class="fas fa-edit mr-3"></i>
                    Edit Daerah
                </h1>
                <p class="text-blue-100">Perbarui informasi daerah: <strong>{{ $daerah->nama_daerah }}</strong></p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="bg-yellow-100 p-2 rounded-lg">
                            <i class="fas fa-pen text-yellow-600"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Form Edit Daerah</h2>
                            <p class="text-sm text-gray-500">ID: #{{ $daerah->id }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <form action="{{ route('admin.daerah.update', $daerah) }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                {{-- Nama Daerah --}}
                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                        Nama Daerah <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="nama_daerah" 
                           value="{{ old('nama_daerah', $daerah->nama_daerah) }}" 
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
                        Nama daerah atau provinsi asal alat musik
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
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none @error('deskripsi') border-red-500 ring-2 ring-red-200 @enderror">{{ old('deskripsi', $daerah->deskripsi) }}</textarea>
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
                        <span>Update Daerah</span>
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
                            <p class="text-blue-800 font-semibold mb-1">Tips Edit</p>
                            <ul class="text-blue-700 text-sm space-y-1">
                                <li>• Pastikan nama daerah sesuai dengan konvensi yang benar</li>
                                <li>• Deskripsi dapat ditambahkan atau diperbarui sesuai kebutuhan</li>
                                <li>• Perubahan akan langsung diterapkan ke semua produk terkait</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Info Card --}}
<div class="max-w-3xl mx-auto mt-6">
    <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl p-6 border border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-calendar-alt text-blue-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Dibuat</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $daerah->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="bg-yellow-100 p-3 rounded-lg">
                        <i class="fas fa-edit text-yellow-600"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Diupdate</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $daerah->updated_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection