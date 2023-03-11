<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Petugas;
use App\Models\Pegawai;
use App\Models\Jenis;
use App\Models\Ruang;
use App\Models\Inventaris;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Petugas::create([
            'username'=>'admin',
            'password'=>bcrypt('password'),
            'nama_petugas'=>'Administrator',
            'level'=>'admin'
        ]);

        Petugas::create([
            'username'=>'operator',
            'password'=>bcrypt('password'),
            'nama_petugas'=>'Operator',
        ]);

        Pegawai::create([
            'username'=>'dodo',
            'password'=>bcrypt(1234),
            'nama_pegawai'=>'Dodo Sidodo',
            'nip'=>'200302032022031001',
            'alamat'=>'Jl. Raya Pangandaran, Pangandaran.'
        ]);

        Jenis::create([
            'kode_jenis'=>'KOMP',
            'nama_jenis'=>'Komputer',
            'keterangan'=>'PC, Laptop, Notebook'
        ]);

        
        Jenis::create([
            'kode_jenis'=>'INF',
            'nama_jenis'=>'Infocus',
        ]);

        
        Jenis::create([
            'kode_jenis'=>'MJ',
            'nama_jenis'=>'Meja',
            'keterangan'=>'Berbagai Jenis Meja'
        ]);

        
        Jenis::create([
            'kode_jenis'=>'KR',
            'nama_jenis'=>'Kursi',
            'keterangan'=>'Berbagai Jenis Kursi',
        ]);

        Ruang::create([
            'kode_ruang'=>'RPL1',
            'nama_ruang'=>'LAB RPL 1',
        ]);

        Ruang::create([
            'kode_ruang'=>'RPL2',
            'nama_ruang'=>'LAB RPL 2',
        ]);

        Ruang::create([
            'kode_ruang'=>'TKJ',
            'nama_ruang'=>'LAB TKJ',
        ]);

        Ruang::create([
            'kode_ruang'=>'GP',
            'nama_ruang'=>'LAB GP',
        ]);

        Inventaris::create([
            'jenis_id'=>1,
            'ruang_id'=>1,
            'petugas_id'=>1,
            'kode_inventaris'=>'K001',
            'nama_inventaris'=>'Komputer PC',
            'kondisi'=>'Baik',
            'jumlah'=>20,
            'tanggal_register'=>date('Y-m-d'),
            'keterangan'=>'Komputer PC Lengkap dengan Monitor'
        ]);

        Inventaris::create([
            'jenis_id'=>3,
            'ruang_id'=>2,
            'petugas_id'=>1,
            'kode_inventaris'=>'M001',
            'nama_inventaris'=>'Meja Komputer',
            'kondisi'=>'Baik',
            'jumlah'=>18,
            'tanggal_register'=>date('Y-m-d'),
        ]);

        Inventaris::create([
            'jenis_id'=>4,
            'ruang_id'=>2,
            'petugas_id'=>1,
            'kode_inventaris'=>'KR001',
            'nama_inventaris'=>'Kursi Plastik',
            'kondisi'=>'Baik',
            'jumlah'=>36,
            'tanggal_register'=>date('Y-m-d'),
            'keterangan'=>'Kursi Plastik Olympus'
        ]);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
