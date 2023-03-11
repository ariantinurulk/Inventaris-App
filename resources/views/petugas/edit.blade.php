@extends('layouts.main',['title'=>'Petugas'])
@section('content')
<x-content :title="[
    'name'=>'Petugas',
    'icon'=>'fas fa-users'
]">
     <div class="row">
        <div class="col-md-6">

            <form
             class="card card-primary"
              method="POST"
              action="{{ route('petugas.update',['petuga'=>$petugas->id]) }}">
                <div class="card-header">
                    <h3 class="card-title">Edit Petugas</h3>
                </div>
                <div class="card-body">
                    @csrf 
                    @method('put')
                    <x-input
                    label="Nama Petugas"
                    name="nama_petugas"
                    :value="$petugas->nama_petugas" />

                    <x-input
                    label="Username"
                    name="username"
                    :value="$petugas->username" />

                    <x-select 
                    label="Level"
                    name="level"
                    :value="$petugas->level"
                    :data-option="[
                        ['value'=>'admin','option'=>'Administrator'],
                        ['value'=>'operator','option'=>'Operator'],
                    ]" />

                    <p class="text-muted mt-5">
                        Apabila tidak melakukan perubahan pada Password,
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