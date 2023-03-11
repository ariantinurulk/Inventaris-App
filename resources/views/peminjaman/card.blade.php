@extends('layouts.report',['title','Kertu Peminjaman Inventaris'])
@section('content')
<div class="container">
    <h3>Kartu Peminjaman Inventaris</h3>
    <div class="row">
        <div class="col">
            <p>
                Nama Peminjam : <strong>{{ $pegawai->nama_pegawai}}</strong><br>
                NIP : {{ $pegawai->nip }}<br>
                Alamat : {{ $pegawai->alamat}}
            </p>
        </div>
        <div class="col">
            <p>
                Tanggal Pinjam : {{ $peminjaman->tanggal_pinjam}}<br>
                Tanggal Kembali : {{ $peminjaman->tanggal_kembali}}<br>
            </p>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
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
            @foreach ( $details as $item)
            <tr>
                <td>{{ $no++}}</td>
                <td>{{ $item->nama_inventaris}}</td>
                <td>{{ $item->nama_jenis}}</td>
                <td>{{ $item->nama_ruang}}</td>
                <td>{{ $item->jumlah_pinjam}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col">
            Telah dikembalikan<br>
            Pada Tanggal ............,<br>
            dan diketahui oleh,
            <br>
            <br>
            <br>
            ............................<br>
            NIP. .......................
        </div>
        <div class="col">
            <br>
            Mengetahui,<br>
            <br>
            <br>
            <br>
            .............................<br>
            NIP. .......................
        </div>
        <div class="col">
            Padaherang, {{ date('d M Y') }}<br>
            Peminjam<br>
            <br>
            <br>
            <br>
            <strong><u>{{ $pegawai->nama_pegawai }}</u></strong> <br>
            NIP. {{ $pegawai->nip}}
        </div>
    </div>
</div>
@endsection