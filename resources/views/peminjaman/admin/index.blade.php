@extends('layouts.main',['title'=>'Peminjaman'])
@section('content')
<x-content :title="[
    'name'=>'Peminjaman',
    'icon'=>'fas fa-hand-holding'
]">

    <div class="card card-outline card-primary">
        <div class="card-header form-inline">
            <div class="input-group">
                <select id="pegawai"
                class="form-control"
                data-live-search="true"
                data-style="btn-secondary">
                    <option value="">Pilih Pegawai Peminjam</option>
                    @foreach ( $pegawais as $pegawai)
                    <option value="{{ $pegawai->id }}">{{ $pegawai->nama_pegawai }}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button id="add" type="button" class="btn btn-primary">
                        Buat Peminjaman
                    </button>
                </div>
            </div>
                <x-search />
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama Pegawai</th>
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
                        <td>
                            <a href="{{ route('admin.peminjaman.info',[
                                'peminjaman'=>$peminjaman->id
                                ]) }}">
                            {{ $peminjaman->nama_pegawai }}
                            </a>
                        </td>
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
                            href="{{ route('admin.peminjaman.info',[
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

@push('css')
<link rel="stylesheet" href="{{ asset('select/css/bootstrap-select.min.css') }}">
@endpush

@push('js')
<script src="{{ asset('select/js/bootstrap-select.min.js') }}"></script>
<script>
$ (function(){
    $('#pegawai').selectpicker();
    $("#add").click(function(){
        let id = $('#pegawai').val();
        if(id){
            let url = "{{ route('admin.peminjaman.create',['pegawai'=>'pegawai-id']) }}";
            url = url.replace('pegawai-id',id);
            window.location.href= url;
        }
    });
});
</script>
@endpush