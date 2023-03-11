@extends('layouts.main',['title'=>'Pegawai'])
@section('content')
<x-content :title="[
    'name'=>'Pegawai',
    'icon'=>'fas fa-id-card-alt'
]">
    <div class="row">
        <div class="col-md-6">

        <form
        class="card card-primary"
        method="POST"
        action="{{ route('pegawai.store') }}">
            <div class="card-header">
                <h3 class="card-title">Add Pegawai</h3>
            </div>
                <div class="card-body">
                    @csrf 
                    <x-input
                    label="Nama Pegawai"
                    name="nama_pegawai" />

                    <x-input
                    label="Username"
                    name="username" />

                    <x-input
                    label="NIP"
                    name="nip" />

                    <x-textarea
                    label="Alamat"
                    name="alamat" />

                    <x-input
                    label="Password"
                    name="password"
                    type="password" />

                    <x-input
                    label="Password Confirmation"
                    name="password_confirmation"
                    type="password" />
                </div>
                <div class="card-footer">
                    <x-btn-submit />
                </div>
            </form>
        </div>
    </div>
</x-content>
@endsection