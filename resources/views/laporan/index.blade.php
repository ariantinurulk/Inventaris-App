@extends('layouts.main',['title'=>'Laporan'])
@section('content')
<x-content :title="[
    'name'=>'Laporan',
    'icon'=>'fas fa-print'
]">
    <div class="row">
        <div class="col-md-4">
            <form 
            class="card card-primary"
            target="_blank"
            action="{{ route('laporan.inventaris') }}">
                <div class="card-header">
                    <h3 class="card-title">Laporan Inventaris</h3>
                </div>
                <div class="card-body">
                    @csrf
                    <x-select
                    label="Ruang"
                    name="ruang_id"
                    :data-option="$ruangs" />
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-print mr-2"></i>
                        Generate Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-content>
@endsection