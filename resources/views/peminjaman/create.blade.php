@extends('layouts.main',['title'=>'Peminjaman'])
@section('content')
<x-content :title="[
    'name'=>'Peminjaman',
    'icon'=>'fas fa-hand-holding'
]">
    @if (session('message') == 'fail store')
    <x-alert-danger />
    @endif

    <div class="card card-primary card-outline">
        <div class="card-header">
            <div class="form-group row">
                <div class="col-lg-2">
                    Nama Peminjam
                </div>
                <div class="col-lg">
                    <strong>
                        {{ $pegawai->nama_pegawai }}
                    </strong>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-2">
                    Cari Inventaris
                </div>
                <div class="col-lg form-inline">
                <div class="input-group">
                    <select id="inventaris"
                    class="form-control"
                    data-live-search="true"
                    data-style="btn-secondary">
                        <option value="">Pilih Barang Inventaris</option>
                        @foreach ( $inventaris as $row)
                        <option value="{{ $row->id }}">
                            {{ $row->nama_inventaris }} /
                            {{ $row->nama_jenis }} /
                            {{ $row->nama_ruang }}
                        </option>
                        @endforeach
                    </select>
                    <div class="input-group-append">
                        <button id="add" type="button" class="btn btn-primary">
                            Tambah
                        </button>
                    </div>
                </div>
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
                        <th>JML</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $no = 1;
                   ?>
                    @foreach ( $items as $item )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->attributes->jenis }}</td>
                        <td>{{ $item->attributes->ruang }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="text-right">
                            <a href="{{ route('peminjaman.update',[
                                'inventari'=>$item->id,
                                'type'=>'plus'
                            ]) }}" class="btn btn-xs btn-primary">
                                <i class="fas fa-plus-square"></i>
                            </a>

                            <a href="{{ route('peminjaman.update',[
                                'inventari'=>$item->id,
                                'type'=>'min'
                            ]) }}" class="btn btn-xs btn-warning mr-3">
                                <i class="fas fa-minus-square"></i>
                            </a>

                            <a href="{{ route('peminjaman.delete',[
                                'inventari'=>$item->id,
                            ]) }}" class="btn btn-xs btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <form
            class="card-footer"
            method="post"
            action="{{ route('peminjaman.create') }}">
                @csrf
                    <div class="row">
                        <div class="offset-md-9 col-md-3">
                            <x-input
                            label="Tanggal Pinjam"
                            name="tanggal_pinjam"
                            type="date" />

                            <x-input
                            label="Tanggal Kembali"
                            name="tanggal_kembali"
                            type="date" />
                        </div>
                    </div>
                    <div class="text-right">
                        <a class="btn btn-danger"
                        href="{{ route('peminjaman.empty') }}">
                            <i class="fas fa-trash mr-2"></i>
                            Clear
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-database mr-2"></i>
                            Proses Peminjaman
                        </button>
                    </div>
                </form>
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
    $('#inventaris').selectpicker();
    $("#add").click(function(){
        let id = $('#inventaris').val();
        if(id){
            let url = "{{ route('peminjaman.add',['inventari'=>'inventaris-id']) }}";
            url = url.replace('inventaris-id',id);
            window.location.href= url;
        }
    });
});
</script>
@endpush