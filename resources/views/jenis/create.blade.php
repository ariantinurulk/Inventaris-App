@extends('layouts.main',['title'=>'Jenis'])
@section('content')
<x-content :title="[
    'name'=>'Jenis',
    'icon'=>'fas fa-archive'
]">
    <div class="row">
        <div class="col-md-6">

        <form
        class="card card-primary"
        method="POST"
        action="{{ route('jenis.store') }}">
            <div class="card-header">
                <h3 class="card-title">Add Jenis</h3>
            </div>
                <div class="card-body">
                    @csrf 
                    <x-input
                    label="Kode Jenis"
                    name="kode_jenis" />

                    <x-input
                    label="Nama Jenis"
                    name="nama_jenis" />

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