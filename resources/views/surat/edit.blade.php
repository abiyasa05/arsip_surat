@extends('layouts.app')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')
    <div class="flex-fill p-4">
        <h2>Arsip Surat &gt;&gt; Edit</h2>
        <p>Edit data surat di bawah ini. <br><b>Catatan:</b><br>&bull; File PDF boleh dikosongkan jika tidak ingin mengganti.</p>
        <form method="POST" action="{{ route('surat.update', $surat->id) }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <div class="mb-3 row">
                <label for="nomor_surat" class="col-sm-3 col-form-label">Nomor Surat</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" required value="{{ old('nomor_surat', $surat->nomor_surat) }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tanggal_surat" class="col-sm-3 col-form-label">Tanggal Surat</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="tanggal_surat" name="tanggal_surat" required value="{{ old('tanggal_surat', $surat->tanggal_surat) }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="kategori" class="col-sm-3 col-form-label">Kategori</label>
                <div class="col-sm-8">
                    <select class="form-select" id="kategori" name="kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->nama_kategori }}" {{ (old('kategori', $surat->kategori)==$kategori->nama_kategori) ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="judul" name="judul" required value="{{ old('judul', $surat->judul) }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="file" class="col-sm-3 col-form-label">File Surat (PDF)</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" id="file" name="file" accept="application/pdf">
                    @if($surat->file_path)
                        <small class="text-muted">File saat ini: <a href="{{ asset('storage/' . $surat->file_path) }}" target="_blank">Lihat PDF</a></small>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('surat.show', $surat->id) }}" class="btn btn-outline-dark">&lt;&lt; Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
