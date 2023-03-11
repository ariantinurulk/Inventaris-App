@extends('layouts.main',['title'=>'Peminjaman'])
@section('content')
<x-content :title="[
    'name'=>'Peminjaman',
    'icon'=>'fas fa-hand-holding'
]">

    <div class="card card-outline card-primary">
        <div class="card-header form-inline">
            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                Tambah Peminjaman
            </a>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $no = $peminjamans->firstItem()
                   ?>
                    @foreach ( $peminjamans as $peminjaman )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $peminjaman->tanggal_pinjam }}</td>
                        <td>{{ $peminjaman->tanggal_kembali }}</td>
                        <td>
                            @if ($peminjaman->status_peminjaman == 'pinjam')
                            <span class="badge badge-success">Pinjam</span>
                            @elseif ($peminjaman->status_peminjaman == 'selesai')
                            <span class="badge badge-info">Selesai</span>
                            @else
                            <span class="badge badge-secondary">Batal</span>
                            @endif
                        </td>
                        <td class="text-right">
                            <x-info
                            href="{{ route('peminjaman.info',[
                                'peminjaman'=>$peminjaman->id
                                ]) }}" />
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $peminjamans->links('page') }}
            </div>
        </div>
</x-content>
@endsection