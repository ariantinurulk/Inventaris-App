@extends('layouts.main',['title'=>'Peminjaman'])
@section('content')
<x-content :title="[
    'name'=>'Peminjaman',
    'icon'=>'fas fa-hand-holding'
]">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <p>
                        Nama Peminjam : <strong>{{ $pegawai->nama_pegawai }}</strong><br>
                        NIP : {{ $pegawai->nip }}<br>
                        Alamat : {{ $pegawai->alamat }}
                    </p>
                </div>
                <div class="col">
                    <p>
                        Tanggal Pinjam : {{ $peminjaman->tanggal_pinjam }} <br>
                        Tanggal Kembali : {{ $peminjaman->tanggal_kembali }} <br>
                        Status :
                        @if ($peminjaman->status_peminjaman == 'pinjam')
                        <span class="badge badge-success">Pinjam</span>
                        @elseif ($peminjaman->status_peminjaman == 'selesai')
                        <span class="badge badge-info">Selesai</span>
                        @else
                        <span class="badge badge-secondary">Batal</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Inventaris</th>
                        <th>Jenis</th>
                        <th>Ruang</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $no = 1;
                   ?>
                    @foreach ( $details as $item )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->nama_inventaris }}</td>
                        <td>{{ $item->nama_jenis }}</td>
                        <td>{{ $item->nama_ruang }}</td>
                        <td>{{ $item->jumlah_pinjam }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right">
                <a href="{{ route('peminjaman.card',[
                    'peminjaman'=>$peminjaman->id
                    ]) }}"
                    class="btn btn-primary">
                    <i class="fas fa-print"></i>
                    Cetak Kartu Peminjaman
                </a>


            </div>
    </div>
</x-content>
@endsection