<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use Illuminate\Http\Request;
use App\Models\DetailAnggaran;

class DirekturController extends Controller
{
    public function pengajuanAnggaran()
    {
        $anggarans = Anggaran::all();
        return view('direktur.pengajuan-anggaran.index', compact('anggarans'));
    }

    public function showDetail($id)
    {
        // Mengambil anggaran dengan detail yang terkait
        $anggaran = Anggaran::with('detailAnggarans')->findOrFail($id);
        
        // Mengirimkan data anggaran ke view 'direktur.pengajuan-anggaran.detail'
        return view('direktur.pengajuan-anggaran.detail', compact('anggaran'));
    }

    public function accAnggaran($id)
    {
        $detailAnggaran = DetailAnggaran::findOrFail($id);
        $detailAnggaran->status_pengajuan = 1; // Setujui
        $detailAnggaran->save(); // Simpan perubahan
    
        return redirect()->route('direktur.pengajuan.detail', $detailAnggaran->id_anggaran)
                         ->with('success', 'Detail anggaran disetujui');
    }
    
}
