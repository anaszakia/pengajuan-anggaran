@extends('admin_super.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Input Data Anggaran </h3>
                </div>
                <div class="card-body">

            <form action="{{ route('admin_super.ASanggaran.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="tanggal_pengajuan" class="form-label">Tanggal Pengajuan</label>
                    <input type="date" name="tanggal_pengajuan" class="form-control" required>
                </div>

                {{-- <div class="mb-3">
                    <label for="no_surat" class="form-label">No Surat</label>
                    <input type="text" name="no_surat" class="form-control" required>
                </div> --}}

                <div class="mb-3">
                    <label for="divisi" class="form-label">Divisi</label>
                    <select name="divisi" class="form-control" required>
                        <option value="">Pilih Divisi</option>
                        <option value="Keuangan">Keuangan</option>
                        <option value="SDM">SDM</option>
                        <option value="Operasional">Operasional</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="plot_yang_dipakai" class="form-label">Plot yang Dipakai</label>
                    <select name="plot_yang_dipakai" class="form-control" required>
                        <option value="">Pilih Divisi</option>
                        <option value="Keuangan">Keuangan</option>
                        <option value="SDM">SDM</option>
                        <option value="Operasional">Operasional</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ajuan_biaya" class="form-label">Ajuan Biaya</label>
                    <input type="number" name="ajuan_biaya" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                    <input type="text" name="nama_karyawan" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin_super.ASanggaran.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
