@extends('layouts.app')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')
    <div class="flex-fill p-4">
        <h2>Tambah Kategori Surat</h2>
        <form method="POST" action="{{ route('kategori.store') }}">
            @csrf

            <!-- ID Auto Increment (hanya ditampilkan) -->
            <div class="mb-3 row">
                <label for="id" class="col-sm-3 col-form-label">ID</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="id" value="{{ $nextId }}" disabled>
                </div>
            </div>

            <!-- Nama Kategori -->
            <div class="mb-3 row">
                <label for="nama_kategori" class="col-sm-3 col-form-label">Nama Kategori</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" required value="{{ old('nama_kategori') }}">
                </div>
            </div>

            <!-- Keterangan -->
            <div class="mb-3 row">
                <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                <div class="col-sm-9">
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="5">{{ old('keterangan') }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-dark">&lt;&lt; Kembali</a>
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection