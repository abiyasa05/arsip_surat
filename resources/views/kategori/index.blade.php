@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('layouts.sidebar')
        <div class="flex-fill p-4">
            <h2>Kategori Surat</h2>
            <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat.<br>Klik "Tambah" pada kolom aksi untuk
                menambahkan kategori baru.</p>

            <form method="GET" action="{{ route('kategori.index') }}" class="mb-3 d-flex align-items-center">
                <label class="me-2 mb-0">Cari kategori:</label>
                <input type="text" name="q" class="form-control w-auto me-2" placeholder="search"
                    value="{{ request('q') }}">
                <button class="btn btn-outline-dark" type="submit">Cari!</button>
            </form>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr id="row-{{ $kategori->id }}">
                            <td>{{ $kategori->id }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td>{{ $kategori->keterangan }}</td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#hapusModal" data-id="{{ $kategori->id }}">
                                    Hapus
                                </button>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada kategori ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $kategoris->links() }}
            <a href="{{ route('kategori.create') }}" class="btn btn-success mt-3">[ + ] Tambah Kategori Baru...</a>
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
                        Yakin ingin menghapus kategori ini?
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
                form.action = '/kategori/' + id;
            });
        });
    </script>
@endsection