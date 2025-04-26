@extends('direktur.layouts.app')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Daftar Pengajuan Anggaran</h5>

        <!-- Menampilkan pesan sukses -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengajuan</th>
                    <th>No Surat</th>
                    <th>Divisi</th>
                    <th>Plot Yang Dipakai</th>
                    <th>Diajukan Oleh</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anggarans as $index => $anggaran)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($anggaran->tanggal_pengajuan)->format('d-m-Y') }}</td>
                        <td>{{ $anggaran->no_surat }}</td>
                        <td>{{ $anggaran->divisi }}</td>
                        <td>{{ $anggaran->divisi }}</td>
                        <td>{{ $anggaran->user->name ?? '-' }}</td>
                        <td>
                                <a href="{{ route('direktur.pengajuan.detail', $anggaran->id) }}" class="btn btn-info">
                                    <i class="bi bi-eye"></i> 
                                </a>
                                
                                <!-- Tombol untuk approve -->
                                @foreach($anggaran->detailAnggarans as $detail)
                                    @if($detail->status_pengajuan == 0) 
                                        <a href="{{ route('direktur.pengajuan.acc', $detail->id) }}" class="btn btn-success">
                                            <i class="bi bi-check-circle"></i>
                                        </a>
                                    @endif
                                @endforeach                                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
