<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Models\DetailAnggaran;
use Illuminate\Support\Facades\Auth;

class DetailAnggaranController extends Controller
{
    // Menampilkan semua detail anggaran
    public function index()
    {
        $detailAnggarans = DetailAnggaran::with('anggaran')->get();
        return view('admin.detail_anggaran.index', compact('detailAnggarans'));
    }

    // Menampilkan form untuk membuat detail anggaran baru
    public function create(Request $request)
    {
        $selectedAnggaranId = $request->id_anggaran;
        $anggarans = \App\Models\Anggaran::all();

        return view('admin.detail-anggaran.create', compact('selectedAnggaranId', 'anggarans'));
    }
    

    // Menyimpan detail anggaran baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'barang_yang_diajukan' => 'required|string|max:255',
            'qty' => 'required|integer',
            'harga' => 'required|numeric',
            'kode_pajak' => 'required|string|max:50',
            'id_anggaran' => 'required|exists:anggarans,id',
        ]);
    
        // Simpan data
        DetailAnggaran::create($validated);
    
        // Cek role user
        $user = Auth::user();
        if ($user->role === 'admin super') {
            return redirect()->route('admin_super.ASanggaran.index')->with('success', 'Detail anggaran berhasil disimpan.');
        } elseif ($user->role === 'admin') {
            return redirect()->route('anggaran.index')->with('success', 'Detail anggaran berhasil disimpan.');
        }
    
        // Jika role tidak dikenali, redirect ke login
        return redirect()->route('login')->with('error', 'Role tidak dikenali.');
    }    

    // Menampilkan detail anggaran berdasarkan id
    public function show($id)
    {
        $detailAnggaran = DetailAnggaran::with('anggaran')->findOrFail($id);
        return view('admin.detail_anggaran.show', compact('detailAnggaran'));
    }

    // Menampilkan form untuk mengedit detail anggaran
    public function edit($id)
    {
        $detailAnggaran = DetailAnggaran::findOrFail($id);
        $anggarans = Anggaran::all(); // Mengambil semua anggaran untuk dropdown
        return view('admin.detail_anggaran.edit', compact('detailAnggaran', 'anggarans'));
    }

    // Mengupdate detail anggaran
    public function update(Request $request, $id)
    {
        $detailAnggaran = DetailAnggaran::findOrFail($id);

        $validated = $request->validate([
            'id_anggaran' => 'required|exists:anggarans,id', 
            'barang_yang_diajukan' => 'required|string|max:255',
            'qty' => 'required|numeric',
            'harga' => 'required|numeric',
            'kode_pajak' => 'required|string|max:50',
            'status_pengajuan' => 'required|string|max:50',
        ]);

        $detailAnggaran->update($validated);

        return redirect()->route('detail-anggaran.index')
            ->with('success', 'Detail anggaran berhasil diperbarui.');
    }

    // Menghapus detail anggaran
    public function destroy($id)
    {
        $detailAnggaran = DetailAnggaran::findOrFail($id);
        $detailAnggaran->delete();

        return redirect()->route('detail-anggaran.index')
            ->with('success', 'Detail anggaran berhasil dihapus.');
    }

    public function showByAnggaran($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $details = DetailAnggaran::where('id_anggaran', $id)->get();

        return view('admin.detail-anggaran.show', compact('anggaran', 'details'));
    }

    public function createas($id_anggaran)
    {
        // Ambil data anggaran untuk digunakan di view
        $anggaran = Anggaran::findOrFail($id_anggaran);

        // Mengirimkan data ke view
        return view('admin_super.detail-anggaran.create', compact('anggaran'));
    }

}
