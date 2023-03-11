@extends('layouts.main',['title'=>'Petugas'])
@section('content')
<x-content :title="[
    'name'=>'Petugas',
    'icon'=>'fas fa-users'
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
                <x-btn-add href="{{ route('petugas.create') }}" />
                <x-search />
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $no = $petugas->firstItem()
                   ?>
                    @foreach ( $petugas as $row )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $row->nama_petugas }}</td>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->level }}</td>
                        <td class="text-right">
                            <x-edit 
                            href="{{ route('petugas.edit',['petuga'=>$row->id]) }}" />

                            <x-delete 
                            data-url="{{ route('petugas.destroy',['petuga'=>$row->id]) }}" />
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $petugas->links('page') }}
            </div>
        </div>
</x-content>
@endsection
@push('modal')
<x-modal-delete />
@endpush