@extends('layouts.main',['title'=>'Ruang'])
@section('content')
<x-content :title="[
    'name'=>'Ruang',
    'icon'=>'fas fa-school'
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
                <x-btn-add href="{{ route('ruang.create') }}" />
                <x-search />
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kode</th>
                        <th>Nama Ruang</th>
                        <th>Keterangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $no = $ruangs->firstItem()
                   ?>
                    @foreach ( $ruangs as $ruang )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $ruang->kode_ruang }}</td>
                        <td>{{ $ruang->nama_ruang }}</td>
                        <td>{{ $ruang->keterangan }}</td>
                        <td class="text-right">
                            <x-edit 
                            href="{{ route('ruang.edit',['ruang'=>$ruang->id]) }}" />

                            <x-delete 
                            data-url="{{ route('ruang.destroy',['ruang'=>$ruang->id]) }}" />
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $ruangs->links('page') }}
            </div>
        </div>
</x-content>
@endsection
@push('modal')
<x-modal-delete />
@endpush