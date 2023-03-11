@extends('layouts.main',['title'=>'Profile'])
@section('content')
<x-content :title="[
    'name'=>'Profile',
    'icon'=>'fas fa-user'
]">
    <div class="row">
        <div class="col-md-6">

            @if (session('message') == 'success update')
                <x-alert-success type="update"/>
            @endif

                <form 
                    class="card card-primary"
                    method="POST"
                    action="{{ route('profile') }}">
                        <div class="card-header">
                            <h3 class="card-title">My Profile</h3>
                        </div>
                        <div class="card-body">
                            @csrf
                            <x-input
                            label="Nama"
                            name="nama_pegawai"
                            :value="$pegawai->nama_pegawai" />

                            <x-input
                            label="Username"
                            name="username"
                            :value="$pegawai->username" />

                            <x-input
                            label="NIP"
                            name="nip"
                            :value="$pegawai->nip" />

                            <x-textarea
                            label="Alamat"
                            name="alamat"
                            :value="$pegawai->alamat" />

                            <p class="text-muted mt-5">
                                Apabila tidak melakukan perubahan pada password,
                                pada inputan Password kosongkan.
                            </p>
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
                            <x-btn-update />
                        </div>
                    </form>
        </div>
    </div>
</x-content>
@endsection