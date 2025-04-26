@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tambah Detail Anggaran</h3>
                </div>
                <div class="card-body">
    {{-- <h2>Tambah Detail Anggaran</h2> --}}
    <!-- Menampilkan info anggaran yang sedang diisi -->
    @if (isset($selectedAnggaranId))
        @php
            $selected = $anggarans->where('id', $selectedAnggaranId)->first();
        @endphp
        <div class="alert alert-info">
            <strong>Mengisi untuk Anggaran:</strong><br>
            <span>No Surat: <strong>{{ $selected->no_surat }}</strong></span><br>
            <span>Divisi: <strong>{{ $selected->divisi }}</strong></span>
        </div>
    @endif

    <!-- Form untuk tambah detail anggaran -->
    <form action="{{ route('detail-anggaran.store') }}" method="POST">
        @csrf

        <!-- Field tersembunyi untuk id_anggaran -->
        <input type="hidden" name="id_anggaran" value="{{ $selectedAnggaranId }}">

        <div class="form-group">
            <label for="barang_yang_diajukan">Barang yang Diajukan</label>
            <input type="text" name="barang_yang_diajukan" id="barang_yang_diajukan"
                   class="form-control @error('barang_yang_diajukan') is-invalid @enderror"
                   value="{{ old('barang_yang_diajukan') }}">
            @error('barang_yang_diajukan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="qty">Jumlah</label>
            <input type="number" name="qty" id="qty"
                   class="form-control @error('qty') is-invalid @enderror"
                   value="{{ old('qty') }}">
            @error('qty')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga"
                   class="form-control @error('harga') is-invalid @enderror"
                   value="{{ old('harga') }}">
            @error('harga')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="kode_pajak">Kode Pajak</label>
            <input type="text" name="kode_pajak" id="kode_pajak"
                   class="form-control @error('kode_pajak') is-invalid @enderror"
                   value="{{ old('kode_pajak') }}">
            @error('kode_pajak')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- <div class="form-group">
            <label for="status_pengajuan">Status Pengajuan</label>
            <select name="status_pengajuan" id="status_pengajuan"
                    class="form-control @error('status_pengajuan') is-invalid @enderror">
                <option value="pending" {{ old('status_pengajuan') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ old('status_pengajuan') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="ditolak" {{ old('status_pengajuan') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            @error('status_pengajuan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> --}}

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('detail-anggaran.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
