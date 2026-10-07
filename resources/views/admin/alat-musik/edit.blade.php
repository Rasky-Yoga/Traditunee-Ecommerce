@extends('layouts.admin')

@section('title', 'Edit Alat Musik')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-yellow-500 to-orange-500 rounded-2xl shadow-xl p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Alat Musik
                </h1>
                <p class="text-orange-100">Perbarui informasi alat musik tradisional</p>
            </div>
            <a href="{{ route('admin.alat-musik.index') }}" 
               class="bg-white text-orange-600 px-6 py-3 rounded-xl font-semibold hover:bg-orange-50 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Form Section --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                {{-- Card Header --}}
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <i class="fas fa-info-circle text-blue-600"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Informasi Alat Musik</h2>
                    </div>
                </div>

                {{-- Form Body --}}
                <div class="p-6">
                    <form action="{{ route('admin.alat-musik.update', $alatMusik->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Nama Alat Musik --}}
                        <div class="mb-6">
                            <label for="nama_alat" class="block text-sm font-bold text-gray-700 mb-2">
                                Nama Alat Musik <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('nama_alat') border-red-500 @else border-gray-300 @enderror" 
                                   id="nama_alat" 
                                   name="nama_alat" 
                                   value="{{ old('nama_alat', $alatMusik->nama_alat) }}"
                                   placeholder="Contoh: Angklung, Gamelan, Sasando"
                                   required>
                            @error('nama_alat')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Daerah & Kategori --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="daerah_id" class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-map-marker-alt text-red-500"></i> Daerah Asal <span class="text-red-500">*</span>
                                </label>
                                <select class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('daerah_id') border-red-500 @else border-gray-300 @enderror" 
                                        id="daerah_id" 
                                        name="daerah_id"
                                        required>
                                    <option value="">-- Pilih Daerah --</option>
                                    @foreach($daerahs as $daerah)
                                        <option value="{{ $daerah->id }}" 
                                            {{ old('daerah_id', $alatMusik->daerah_id) == $daerah->id ? 'selected' : '' }}>
                                            {{ $daerah->nama_daerah }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('daerah_id')
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="kategori_id" class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-tag text-blue-500"></i> Kategori <span class="text-red-500">*</span>
                                </label>
                                <select class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('kategori_id') border-red-500 @else border-gray-300 @enderror" 
                                        id="kategori_id" 
                                        name="kategori_id"
                                        required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" 
                                            {{ old('kategori_id', $alatMusik->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-6">
                            <label for="deskripsi" class="block text-sm font-bold text-gray-700 mb-2">
                                <i class="fas fa-align-left text-gray-500"></i> Deskripsi <span class="text-red-500">*</span>
                            </label>
                            <textarea class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('deskripsi') border-red-500 @else border-gray-300 @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="5"
                                      placeholder="Jelaskan sejarah, fungsi, dan keunikan alat musik ini..."
                                      required>{{ old('deskripsi', $alatMusik->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Harga & Stok --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="harga" class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-dollar-sign text-green-500"></i> Harga <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <span class="text-gray-500 font-semibold">Rp</span>
                                    </div>
                                    <input type="number" 
                                           class="w-full pl-12 pr-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all @error('harga') border-red-500 @else border-gray-300 @enderror" 
                                           id="harga" 
                                           name="harga" 
                                           value="{{ old('harga', $alatMusik->harga) }}"
                                           min="0"
                                           step="1000"
                                           placeholder="0"
                                           required>
                                </div>
                                @error('harga')
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <div>
                                <label for="stok" class="block text-sm font-bold text-gray-700 mb-2">
                                    <i class="fas fa-boxes text-blue-500"></i> Stok <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       class="w-full px-4 py-3 border-2 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all @error('stok') border-red-500 @else border-gray-300 @enderror" 
                                       id="stok" 
                                       name="stok" 
                                       value="{{ old('stok', $alatMusik->stok) }}"
                                       min="0"
                                       placeholder="0"
                                       required>
                                @error('stok')
                                    <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                        <i class="fas fa-exclamation-circle"></i>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
                            <button type="submit" 
                                    class="flex-1 bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:from-indigo-700 hover:to-blue-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                <i class="fas fa-save"></i>
                                Update Alat Musik
                            </button>
                            <a href="{{ route('admin.alat-musik.index') }}" 
                               class="flex-1 bg-gray-100 text-gray-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center justify-center gap-2">
                                <i class="fas fa-times"></i>
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Sidebar Section --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Image Preview Card --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-50 to-pink-50 px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center gap-3">
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <i class="fas fa-image text-purple-600"></i>
                        </div>
                        <h2 class="text-lg font-bold text-gray-800">Gambar Alat Musik</h2>
                    </div>
                </div>

                <div class="p-6">
                    {{-- Current Image Preview --}}
                    <div class="mb-4">
                        <div class="relative group">
                            @if($alatMusik->gambar)
                                <img src="{{ asset('storage/' . $alatMusik->gambar) }}" 
                                     alt="{{ $alatMusik->nama_alat }}" 
                                     class="w-full h-64 object-cover rounded-xl shadow-md"
                                     id="preview-image">
                                <div class="absolute top-3 right-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 shadow-lg">
                                    <i class="fas fa-check-circle"></i>
                                    Gambar Tersimpan
                                </div>
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-gray-200 to-gray-300 rounded-xl flex items-center justify-center" id="preview-container">
                                    <div class="text-center">
                                        <i class="fas fa-image text-gray-400 text-5xl mb-3"></i>
                                        <p class="text-gray-500 font-medium">Tidak Ada Gambar</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Upload Form --}}
                    <form action="{{ route('admin.alat-musik.update', $alatMusik->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Hidden fields --}}
                        <input type="hidden" name="nama_alat" value="{{ $alatMusik->nama_alat }}">
                        <input type="hidden" name="daerah_id" value="{{ $alatMusik->daerah_id }}">
                        <input type="hidden" name="kategori_id" value="{{ $alatMusik->kategori_id }}">
                        <input type="hidden" name="deskripsi" value="{{ $alatMusik->deskripsi }}">
                        <input type="hidden" name="harga" value="{{ $alatMusik->harga }}">
                        <input type="hidden" name="stok" value="{{ $alatMusik->stok }}">
                        
                        {{-- File Input --}}
                        <div class="mb-4">
                            <label class="block w-full cursor-pointer">
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-indigo-500 transition-colors duration-200 bg-gray-50 hover:bg-indigo-50">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Klik untuk pilih gambar</p>
                                    <p class="text-xs text-gray-400" id="file-name">atau drag & drop di sini</p>
                                </div>
                                <input type="file" 
                                       class="hidden" 
                                       id="gambar" 
                                       name="gambar"
                                       accept="image/jpeg,image/png,image/jpg"
                                       onchange="previewImage(this)">
                            </label>
                            @error('gambar')
                                <p class="mt-2 text-sm text-red-600 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-3 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                            <i class="fas fa-upload"></i>
                            Upload Gambar Baru
                        </button>
                    </form>
                    
                    {{-- Info Alert --}}
                    <div class="mt-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
                            <div class="text-sm text-blue-700">
                                <p class="font-semibold mb-1">Informasi Upload:</p>
                                <ul class="list-disc list-inside space-y-1 text-xs">
                                    <li>Format: JPG, PNG</li>
                                    <li>Ukuran: Maksimal 2MB</li>
                                    <li>Rasio: 1:1 atau 4:3 (disarankan)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Info Card --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border-l-4 border-indigo-500">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-indigo-100 p-2 rounded-lg">
                            <i class="fas fa-clock text-indigo-600"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Informasi Waktu</h3>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs font-semibold text-gray-500 mb-1">Dibuat Pada:</p>
                            <p class="text-sm font-bold text-gray-800">
                                {{ $alatMusik->created_at ? $alatMusik->created_at->format('d M Y, H:i') : '-' }}
                            </p>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-3">
                            <p class="text-xs font-semibold text-gray-500 mb-1">Terakhir Diupdate:</p>
                            <p class="text-sm font-bold text-gray-800">
                                {{ $alatMusik->updated_at ? $alatMusik->updated_at->format('d M Y, H:i') : '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Stats Card --}}
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 text-white">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-white bg-opacity-20 p-2 rounded-lg">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="font-bold">Status Produk</h3>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-indigo-100 text-sm">Harga Jual:</span>
                            <span class="font-bold">Rp {{ number_format($alatMusik->harga, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-indigo-100 text-sm">Stok Tersedia:</span>
                            <span class="font-bold">{{ $alatMusik->stok }} Unit</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-indigo-100 text-sm">Status:</span>
                            @if($alatMusik->stok > 5)
                                <span class="px-3 py-1 bg-green-500 rounded-full text-xs font-bold">Stok Aman</span>
                            @elseif($alatMusik->stok > 0)
                                <span class="px-3 py-1 bg-yellow-500 rounded-full text-xs font-bold">Stok Rendah</span>
                            @else
                                <span class="px-3 py-1 bg-red-500 rounded-full text-xs font-bold">Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Image Preview Script --}}
<script>
function previewImage(input) {
    const file = input.files[0];
    const fileNameElement = document.getElementById('file-name');
    
    if (file) {
        fileNameElement.textContent = file.name;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewImage = document.getElementById('preview-image');
            if (previewImage) {
                previewImage.src = e.target.result;
            } else {
                // If no image exists, replace the placeholder
                const container = document.getElementById('preview-container');
                if (container) {
                    container.outerHTML = `<img src="${e.target.result}" alt="Preview" class="w-full h-64 object-cover rounded-xl shadow-md" id="preview-image">`;
                }
            }
        }
        reader.readAsDataURL(file);
    } else {
        fileNameElement.textContent = 'atau drag & drop di sini';
    }
}

// Add drag and drop functionality
const dropZone = document.querySelector('label[for="gambar"]');
if (dropZone) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropZone.querySelector('div').classList.add('border-indigo-500', 'bg-indigo-50');
    }

    function unhighlight(e) {
        dropZone.querySelector('div').classList.remove('border-indigo-500', 'bg-indigo-50');
    }

    dropZone.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        document.getElementById('gambar').files = files;
        previewImage(document.getElementById('gambar'));
    }
}
</script>
@endsection