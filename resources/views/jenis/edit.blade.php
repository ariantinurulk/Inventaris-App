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
              action="{{ route('jenis.update',['jeni'=>$jenis->id]) }}">

                <div class="card-header">
                    <h3 class="card-title">Edit Jenis</h3>
                </div>
                <div class="card-body">
                    @csrf 
                    @method('put')

                    <x-input
                    label="Kode Jenis"
                    name="kode_jenis"
                    :value="$jenis->kode_jenis" />

                    <x-input
                    label="Nama Jenis"
                    name="nama_jenis"
                    :value="$jenis->nama_jenis" />

                    <x-textarea
                    label="Keterangan"
                    name="keterangan"
                    :value="$jenis->keterangan" />
                    
                </div>
                <div class="card-footer">
                    <x-btn-update />
                </div>
            </form>
        </div>
     </div>
</x-content>
@endsection