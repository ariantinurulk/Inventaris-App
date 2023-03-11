<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id')->constrained('jenis')
            ->onDelete('cascade')->onUpdate('no action');
            $table->foreignId('ruang_id')->constrained('ruangs')
            ->onDelete('cascade')->onUpdate('no action');
            $table->foreignId('petugas_id')->constrained('petugas')
            ->onDelete('cascade')->onUpdate('no action');
            $table->string('kode_inventaris')->unique();
            $table->string('nama_inventaris');
            $table->string('kondisi');
            $table->integer('jumlah');
            $table->date('tanggal_register');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventaris');
    }
};
