{{-- resources/views/admin/daerah/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Daerah')

@section('content')
<div class="container-fluid">
    {{-- Header Section --}}
    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 rounded-2xl shadow-xl p-8 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl font-bold text-white mb-2 flex items-center">
                    <i class="fas fa-map-marked-alt mr-3"></i>
                    Kelola Daerah
                </h1>
                <p class="text-blue-100">Kelola data daerah asal alat musik tradisional</p>
            </div>
            <a href="{{ route('admin.daerah.create') }}" 
               class="bg-white text-blue-600 px-6 py-3 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center gap-2">
                <i class="fas fa-plus"></i>
                <span>Tambah Daerah</span>
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

    {{-- Main Card --}}
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        {{-- Card Header --}}
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <i class="fas fa-list text-blue-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Data Daerah</h2>
                        <p class="text-sm text-gray-500">Total: {{ $daerahs->total() }} daerah</p>
                    </div>
                </div>
                
                {{-- Search / Filter Area (Optional) --}}
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700">
                        <i class="fas fa-filter mr-2"></i>Filter
                    </button>
                    <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors text-sm font-medium text-gray-700">
                        <i class="fas fa-download mr-2"></i>Export
                    </button>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Nama Daerah</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Jumlah Produk</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($daerahs as $index => $daerah)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900">{{ $daerahs->firstItem() + $index }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="bg-gradient-to-br from-blue-100 to-cyan-100 w-12 h-12 rounded-lg flex items-center justify-center shadow-md">
                                        <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-gray-900">{{ $daerah->nama_daerah }}</p>
                                        <p class="text-xs text-gray-500">ID: #{{ $daerah->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-700 max-w-md">{{ Str::limit($daerah->deskripsi, 80) }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-guitar text-indigo-500 text-xs"></i>
                                    <span class="px-3 py-1 text-sm font-bold rounded-full bg-indigo-100 text-indigo-700">
                                        {{ $daerah->alat_musiks_count }} Produk
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    {{-- Detail Button --}}
                                    <button class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors duration-200 group" title="Detail">
                                        <i class="fas fa-eye group-hover:scale-110 transition-transform"></i>
                                    </button>
                                    
                                    {{-- Edit Button --}}
                                    <a href="{{ route('admin.daerah.edit', $daerah) }}" 
                                       class="p-2 bg-yellow-50 text-yellow-600 rounded-lg hover:bg-yellow-100 transition-colors duration-200 group"
                                       title="Edit">
                                        <i class="fas fa-edit group-hover:scale-110 transition-transform"></i>
                                    </a>
                                    
                                    {{-- Delete Button --}}
                                    <form action="{{ route('admin.daerah.destroy', $daerah) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('⚠️ Yakin ingin menghapus daerah ini?\n\nNama: {{ $daerah->nama_daerah }}\nJumlah Produk: {{ $daerah->alat_musiks_count }}\n\nData yang dihapus tidak dapat dikembalikan!')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors duration-200 group"
                                                title="Hapus">
                                            <i class="fas fa-trash group-hover:scale-110 transition-transform"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12">
                                <div class="text-center">
                                    <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <i class="fas fa-map-marked-alt text-gray-400 text-3xl"></i>
                                    </div>
                                    <p class="text-gray-600 font-semibold mb-2">Tidak ada data daerah</p>
                                    <p class="text-gray-400 text-sm mb-4">Mulai tambahkan daerah pertama Anda</p>
                                    <a href="{{ route('admin.daerah.create') }}" 
                                       class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        <i class="fas fa-plus"></i>
                                        Tambah Daerah
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($daerahs->hasPages())
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-600">
                    Menampilkan <span class="font-semibold text-gray-900">{{ $daerahs->firstItem() }}</span> 
                    sampai <span class="font-semibold text-gray-900">{{ $daerahs->lastItem() }}</span> 
                    dari <span class="font-semibold text-gray-900">{{ $daerahs->total() }}</span> data
                </div>
                <div>
                    {{ $daerahs->links() }}
                </div>
            </div>
        </div>
        @endif
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