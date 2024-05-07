<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_id');
            $table->string('nik');
            $table->string('alamat_pemilik');
            $table->bigInteger('rt_id');
            $table->bigInteger('kategori_umkm_id');
            $table->bigInteger('jenis_umkm_id');
            $table->string('nama_usaha');
            $table->string('alamat_usaha');
            $table->string('telp');
            $table->enum('status', ['iya', 'tidak'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
