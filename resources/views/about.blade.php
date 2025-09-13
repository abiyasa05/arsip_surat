@extends('layouts.app')

@section('content')
<div class="d-flex">
    @include('layouts.sidebar')
    <div class="flex-fill p-4">
        <h2>About</h2>
        <div class="d-flex align-items-center mt-4" style="gap: 32px;">
            <div>
                <img src="{{ asset('img/profile.jpg') }}" alt="Foto Profil" style="width:140px; height:140px; object-fit:cover; border-radius:16px; border:3px solid #222; background:#eee;">
            </div>
            <div style="font-size:1.15rem;">
                <div>Aplikasi ini dibuat oleh:</div>
                <table class="mt-2">
                    <tr><td>Nama</td><td>:</td><td>Abiyasa Putra Prasetya</td></tr>
                    <tr><td>Prodi</td><td>:</td><td>D4 Teknik Infomatika</td></tr>
                    <tr><td>NIM</td><td>:</td><td>2141720203</td></tr>
                    <tr><td>Tanggal</td><td>:</td><td>13 Oktober 2025</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
