@extends('layouts.app')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')

    <div class="flex-grow-1 d-flex flex-column" 
         style="min-width:0; min-height:100vh; padding-left:24px; padding-right:24px;">

        <h2 class="mb-2">Arsip Surat &gt;&gt; Lihat</h2>
        <div class="mb-3">
            <b>Nomor:</b> {{ $surat->nomor_surat }}<br>
            <b>Kategori:</b> {{ $surat->kategori }}<br>
            <b>Judul:</b> {{ $surat->judul }}<br>
            <b>Waktu Unggah:</b> {{ $surat->created_at->format('Y-m-d H:i') }}
        </div>

        <!-- PDF area ambil semua sisa tinggi -->
        <div class="flex-grow-1 d-flex flex-column" style="min-height:0;">
            <div class="pdf-wrapper flex-grow-1 bg-white border rounded-2 shadow-sm" 
                style="min-height:0; margin-inline:8px; 
                        width:calc(100vw - 250px - 48px); max-width:100vw;">
                <iframe 
                    src="{{ asset('storage/' . $surat->file_path) }}"
                    style="background:#e9ecef; border-radius:8px; border:none; 
                        width:100%; height:100%; display:block;">
                </iframe>
            </div>
        </div>

        <!-- Tombol -->
        <div class="d-flex gap-2 justify-content-center mt-3 mb-4">
            <a href="{{ route('surat.index') }}" class="btn btn-outline-dark">&lt;&lt; Kembali</a>
            <a href="{{ route('surat.download', $surat->id) }}" class="btn btn-warning">Unduh</a>
            <a href="{{ route('surat.edit', $surat->id) }}" class="btn btn-primary">Edit/Ganti File</a>
        </div>
    </div>
</div>
@endsection
