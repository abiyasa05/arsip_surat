<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    // Tampilkan detail surat
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.show', compact('surat'));
    }
    // Tampilkan daftar surat dan form pencarian
    public function index(Request $request)
    {
        $query = Surat::query();
        if ($request->has('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }
        $surats = $query->orderBy('tanggal_surat', 'desc')->paginate(10);
        return view('surat.index', compact('surats'));
    }

    // Tampilkan form upload surat
    public function create()
    {
        $kategoris = \App\Models\Kategori::orderBy('nama_kategori')->get();
        return view('surat.create', compact('kategoris'));
    }

    // Simpan surat baru
    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'required|string',
            'kategori' => 'required|string',
            'judul' => 'required|string',
            'tanggal_surat' => 'required|date',
            'file' => 'required|mimes:pdf',
        ]);

        $filePath = $request->file('file')->store('surat', 'public');

        Surat::create([
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'tanggal_surat' => $request->tanggal_surat,
            'file_path' => $filePath,
        ]);

        return redirect()->route('surat.index')->with('success', 'Data berhasil disimpan');
    }

    // Download file surat
    public function download($id)
    {
    $surat = Surat::findOrFail($id);
    $file = storage_path('app/public/' . $surat->file_path);
    return response()->download($file, $surat->judul . '.pdf');
    }
    // Hapus surat
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        // Hapus file PDF jika ada
        if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
            Storage::disk('public')->delete($surat->file_path);
        }
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus!');
    }

    // Tampilkan form edit surat
    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $kategoris = \App\Models\Kategori::orderBy('nama_kategori')->get();
        return view('surat.edit', compact('surat', 'kategoris'));
    }
    // Update surat
    public function update(Request $request, $id)
    {
        $surat = Surat::findOrFail($id);
        $request->validate([
            'nomor_surat' => 'required|string',
            'kategori' => 'required|string',
            'judul' => 'required|string',
            'tanggal_surat' => 'required|date',
            'file' => 'nullable|mimes:pdf',
        ]);

        $data = [
            'nomor_surat' => $request->nomor_surat,
            'kategori' => $request->kategori,
            'judul' => $request->judul,
            'tanggal_surat' => $request->tanggal_surat,
        ];

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($surat->file_path && Storage::disk('public')->exists($surat->file_path)) {
                Storage::disk('public')->delete($surat->file_path);
            }
            $data['file_path'] = $request->file('file')->store('surat', 'public');
        }

        $surat->update($data);

        return redirect()->route('surat.show', $surat->id)->with('success', 'Data surat berhasil diperbarui!');
    }
}
