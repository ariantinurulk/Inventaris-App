@extends('layouts.main',['title'=>'Ruang'])
@section('content')
<x-content :title="[
    'name'=>'Ruang',
    'icon'=>'fas fa-school'
]">
    <div class="row">
        <div class="col-md-6">

        <form
        class="card card-primary"
        method="POST"
        action="{{ route('ruang.store') }}">
            <div class="card-header">
                <h3 class="card-title">Add Ruang</h3>
            </div>
                <div class="card-body">
                    @csrf 
                    <x-input
                    label="Kode Ruang"
                    name="kode_ruang" />

                    <x-input
                    label="Nama Ruang"
                    name="nama_ruang" />

                    <x-textarea
                    label="Keterangan"
                    name="keterangan" />

                </div>
                <div class="card-footer">
                    <x-btn-submit />
                </div>
            </form>
        </div>
    </div>
</x-content>
@endsection