<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // Tampilkan daftar kategori
    public function index(Request $request)
    {
        $query = Kategori::query();
        if ($request->has('q')) {
            $query->where('nama_kategori', 'like', '%' . $request->q . '%');
        }
        $kategoris = $query->orderBy('id')->paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    // Tampilkan form tambah kategori
    public function create()
    {
        $lastId = Kategori::max('id');   // ambil ID terakhir
        $nextId = $lastId ? $lastId + 1 : 1; // kalau kosong mulai dari 1

        return view('kategori.create', compact('nextId'));
    }

    // Simpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);
        Kategori::create($request->only(['nama_kategori', 'keterangan']));
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    // Tampilkan form edit kategori
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    // Update kategori
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string',
            'keterangan' => 'nullable|string',
        ]);
        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only(['nama_kategori', 'keterangan']));
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate');
    }

    // Hapus kategori
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
