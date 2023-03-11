@extends('layouts.main',['title'=>'Inventaris'])
@section('content')
<x-content :title="[
    'name'=>'Inventaris',
    'icon'=>'fas fa-desktop'
]">
    @if (session('message')=='success store')
    <x-alert-success />
    @endif

    @if (session('message')=='success update')
    <x-alert-success type="update" />
    @endif

    @if (session('message')=='success delete')
    <x-alert-success type="delete" />
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header form-inline">
                <x-btn-add href="{{ route('inventaris.create') }}" />
                <x-search />
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kode</th>
                        <th>Nama Inventaris</th>
                        <th>Jenis</th>
                        <th>Ruang</th>
                        <th>JML</th>
                        <th>Keterangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $no = $inventaris->firstItem()
                   ?>
                    @foreach ( $inventaris as $row )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->kode_inventaris }}</td>
                        <td>
                            <strong>{{ $row->nama_inventaris }}</strong> <br>
                            <small>
                                Ket : {{ $row->keterangan ?? '-' }} <br>
                                Register : {{ $row->tanggal_register }} -
                                {{ $row->nama_petugas}}
                            </small>
                        </td>
                        <td>{{ $row->nama_jenis }}</td>
                        <td>{{ $row->nama_ruang }}</td>
                        <td>{{ $row->jumlah }}</td>
                        <td>{{ $row->kondisi }}</td>
                        <td class="text-right">
                            <x-edit 
                            href="{{ route('inventaris.edit',['inventari'=>$row->id]) }}" />

                            <x-delete 
                            data-url="{{ route('inventaris.destroy',['inventari'=>$row->id]) }}" />
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $inventaris->links('page') }}
            </div>
        </div>
</x-content>
@endsection
@push('modal')
<x-modal-delete />
@endpush