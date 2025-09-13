@extends('layouts.app')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')

    <div class="flex-fill p-4">
        <h2>Arsip Surat</h2>
        <p>
            Berikut ini adalah surat-surat yang telah terbit dan diarsipkan.<br>
            Klik "Lihat" pada kolom aksi untuk menampilkan surat.
        </p>

        <form method="GET" action="{{ route('surat.index') }}" class="mb-3 d-flex align-items-center">
            <label class="me-2 mb-0">Cari surat:</label>
            <input type="text" name="q" class="form-control w-auto me-2" placeholder="search" value="{{ request('q') }}">
            <button class="btn btn-outline-dark" type="submit">Cari!</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Nomor Surat</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Waktu Pengarsipan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($surats as $surat)
                <tr id="row-{{ $surat->id }}">
                    <td>{{ $surat->nomor_surat ?? '-' }}</td>
                    <td>{{ $surat->kategori ?? '-' }}</td>
                    <td>{{ $surat->judul }}</td>
                    <td>{{ $surat->created_at->format('Y-m-d H:i') }}</td>
                    <td style="white-space: nowrap;">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#hapusModal" data-id="{{ $surat->id }}">
                            Hapus
                        </button>
                        <a href="{{ route('surat.download', $surat->id) }}" class="btn btn-warning btn-sm">Unduh</a>
                        <a href="{{ route('surat.show', $surat->id) }}" class="btn btn-primary btn-sm">Lihat &gt;&gt;</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada surat ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $surats->links() }}

        <a href="{{ route('surat.create') }}" class="btn btn-outline-dark mt-3">
            Arsipkan Surat..
        </a>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="hapusForm" method="POST">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Yakin ingin menghapus surat ini?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var hapusModal = document.getElementById('hapusModal');
    hapusModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        var form = hapusModal.querySelector('#hapusForm');
        form.action = '/surat/' + id;
    });
});
</script>
@endsection