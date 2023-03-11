<aside class="main-sidebar sidebar-dark-primary elevation-4">
<a href="/" class="brand-link">
    <img src="/images/logo.png" 
    class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">
        {{ config('app.name') }}
    </span>
</a>
<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" 
        data-widget="treeview"
        role="menu" 
        data-accordion="false">

        @auth('admin')
        <x-nav-item href="{{ route('admin.dashboard') }}" :title="[
                'name'=>'Dashboard',
                'icon'=>'fas fa-home',
                'active'=>['admin.dashboard']
        ]"/>

        <x-nav-item href="{{ route('admin.peminjaman.index') }}" :title="[
                'name'=>'Peminjaman',
                'icon'=>'fas fa-hand-holding',
                'active'=>['admin.peminjaman.index','admin.peminjaman.create','admin.peminjaman.info']
        ]"/>
        @can('admin')
        <x-nav-item href="{{ route('petugas.index') }}" :title="[
                'name'=>'Petugas',
                'icon'=>'fas fa-users',
                'active'=>['petugas.index','petugas.create','petugas.edit']
        ]"/>

        <x-nav-item href="{{ route('pegawai.index') }}" :title="[
                'name'=>'Pegawai',
                'icon'=>'fas fa-id-card-alt',
                'active'=>['pegawai.index','pegawai.create','pegawai.edit']
        ]"/>

        <x-nav-item href="{{ route('jenis.index') }}" :title="[
                'name'=>'Jenis',
                'icon'=>'fas fa-archive',
                'active'=>['jenis.index','jenis.create','jenis.edit']
        ]"/>

        <x-nav-item href="{{ route('ruang.index') }}" :title="[
                'name'=>'Ruang',
                'icon'=>'fas fa-school',
                'active'=>['ruang.index','ruang.create','ruang.edit']
        ]"/>

        <x-nav-item href="{{ route('inventaris.index') }}" :title="[
                'name'=>'Inventaris',
                'icon'=>'fas fa-desktop',
                'active'=>['inventaris.index','inventaris.create','inventaris.edit']
        ]"/>

        <x-nav-item href="{{ route('laporan.index') }}" :title="[
                'name'=>'Laporan',
                'icon'=>'fas fa-print',
                'active'=>['laporan.index']
        ]"/>

        @endcan
        @else
        <x-nav-item href="{{ route('dashboard') }}" :title="[
                'name'=>'Dashboard',
                'icon'=>'fas fa-home',
                'active'=>['dashboard']
        ]"/>

        <x-nav-item href="{{ route('peminjaman.index') }}" :title="[
                'name'=>'Peminjaman',
                'icon'=>'fas fa-hand-holding',
                'active'=>['peminjaman.index','peminjaman.create','peminjaman.info']
        ]"/>
        @endauth
    </nav>
</div>
</aside>