@extends('layouts.main',['title'=>'Pegawai'])
@section('content')
<x-content :title="[
    'name'=>'Pegawai',
    'icon'=>'fas fa-id-card-alt'
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
                <x-btn-add href="{{ route('pegawai.create') }}" />
                <x-search />
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped m-0">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Alamat</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                   <?php
                   $no = $pegawais->firstItem()
                   ?>
                    @foreach ( $pegawais as $pegawai )
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>
                            {{ $pegawai->nama_pegawai }} <br>
                            <small>NIP : {{ $pegawai->nip }}</small>
                        </td>
                        <td>{{ $pegawai->username }}</td>
                        <td>{{ $pegawai->alamat }}</td>
                        <td class="text-right">
                            <x-edit 
                            href="{{ route('pegawai.edit',['pegawai'=>$pegawai->id]) }}" />

                            <x-delete 
                            data-url="{{ route('pegawai.destroy',['pegawai'=>$pegawai->id]) }}" />
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{ $pegawais->links('page') }}
            </div>
        </div>
</x-content>
@endsection
@push('modal')
<x-modal-delete />
@endpush