@extends('layouts.main',['title'=>'Jenis'])
@section('content')
<x-content :title="[
    'name'=>'Jenis',
    'icon'=>'fas fa-archive'
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
                <x-btn-add href="{{ route('jenis.create') }}" />
                <x-search />
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kode</th>
                        <th>Nama Jenis</th>
                        <th>Keterangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $no = $jenis->firstItem()
                   ?>
                    @foreach ( $jenis as $row )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->kode_jenis }}</td>
                        <td>{{ $row->nama_jenis }}</td>
                        <td>{{ $row->keterangan }}</td>
                        <td class="text-right">
                            <x-edit 
                            href="{{ route('jenis.edit',['jeni'=>$row->id]) }}" />

                            <x-delete 
                            data-url="{{ route('jenis.destroy',['jeni'=>$row->id]) }}" />
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $jenis->links('page') }}
            </div>
        </div>
</x-content>
@endsection
@push('modal')
<x-modal-delete />
@endpush