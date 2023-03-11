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
        action="{{ route('petugas.store') }}">
            <div class="card-header">
                <h3 class="card-title">Add Petugas</h3>
            </div>
                <div class="card-body">
                    @csrf 
                    <x-input
                    label="Nama Petugas"
                    name="nama_petugas" />

                    <x-input
                    label="Username"
                    name="username" />

                    <x-select 
                    label="Level"
                    name="level"
                    :data-option="[
                        ['value'=>'admin','option'=>'Administrator'],
                        ['value'=>'operator','option'=>'Operator'],
                    ]" />

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