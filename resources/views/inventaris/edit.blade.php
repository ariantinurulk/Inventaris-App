@extends('layouts.main',['title'=>'Inventaris'])
@section('content')
<x-content :title="[
    'name'=>'Inventaris',
    'icon'=>'fas fa-desktop'
]">
     <div class="row">
        <div class="col-md-6">

            <form
             class="card card-primary"
              method="POST"
              action="{{ route('inventaris.update',['inventari'=>$inventaris->id]) }}">

                <div class="card-header">
                    <h3 class="card-title">Edit Inventaris</h3>
                </div>
                <div class="card-body">
                    @csrf 
                    @method('put')

                    <x-input
                    label="Kode Inventaris"
                    name="kode_inventaris"
                    :value="$inventaris->kode_inventaris" />

                    <x-input
                    label="Nama Inventaris"
                    name="nama_inventaris"
                    :value="$inventaris->nama_inventaris" />

                    <x-select
                    label="Jenis"
                    name="jenis_id"
                    :value="$inventaris->jenis_id"
                    :data-option="$jenis" />

                    <x-select
                    label="Ruang"
                    name="ruang_id"
                    :value="$inventaris->ruang_id"
                    :data-option="$ruang" />

                    <x-input
                    label="Jumlah"
                    name="jumlah"
                    :value="$inventaris->jumlah" />

                    <x-input
                    label="Kondisi"
                    name="kondisi"
                    :value="$inventaris->kondisi" />

                    <x-input
                    label="Tanggal Register"
                    name="tanggal_register"
                    type="date"
                    :value="$inventaris->tanggal_register" />

                    <x-textarea
                    label="Keterangan"
                    name="keterangan"
                    :value="$inventaris->keterangan" />
                </div>
                <div class="card-footer">
                    <x-btn-update />
                </div>
            </form>
        </div>
     </div>
</x-content>
@endsection