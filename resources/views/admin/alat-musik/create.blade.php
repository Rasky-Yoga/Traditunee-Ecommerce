@extends('layouts.admin')

@section('title', 'Tambah Alat Musik')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Alat Musik</h1>
        <a href="{{ route('admin.alat-musik.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.alat-musik.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nama_alat">Nama Alat Musik <span class="text-danger">*</span></label>
                    <input type="text" 
                           class="form-control @error('nama_alat') is-invalid @enderror" 
                           id="nama_alat" 
                           name="nama_alat" 
                           value="{{ old('nama_alat') }}"
                           required>
                    @error('nama_alat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="daerah_id">Daerah <span class="text-danger">*</span></label>
                            <select class="form-control @error('daerah_id') is-invalid @enderror" 
                                    id="daerah_id" 
                                    name="daerah_id"
                                    required>
                                <option value="">Pilih Daerah</option>
                                @foreach($daerahs as $daerah)
                                    <option value="{{ $daerah->id }}" {{ old('daerah_id') == $daerah->id ? 'selected' : '' }}>
                                        {{ $daerah->nama_daerah }}
                                    </option>
                                @endforeach
                            </select>
                            @error('daerah_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kategori_id">Kategori <span class="text-danger">*</span></label>
                            <select class="form-control @error('kategori_id') is-invalid @enderror" 
                                    id="kategori_id" 
                                    name="kategori_id"
                                    required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                              id="deskripsi" 
                              name="deskripsi" 
                              rows="4"
                              required>{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" 
                                       class="form-control @error('harga') is-invalid @enderror" 
                                       id="harga" 
                                       name="harga" 
                                       value="{{ old('harga') }}"
                                       min="0"
                                       required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stok">Stok <span class="text-danger">*</span></label>
                            <input type="number" 
                                   class="form-control @error('stok') is-invalid @enderror" 
                                   id="stok" 
                                   name="stok" 
                                   value="{{ old('stok') }}"
                                   min="0"
                                   required>
                            @error('stok')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" 
                           class="form-control-file @error('gambar') is-invalid @enderror" 
                           id="gambar" 
                           name="gambar"
                           accept="image/jpeg,image/png,image/jpg">
                    <small class="form-text text-muted">
                        Format: JPG, JPEG, PNG. Maksimal 2MB.
                    </small>
                    @error('gambar')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('admin.alat-musik.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection