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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('level', ['admin', 'rt', 'user'])->nullable();
            $table->string('wilayah_rt')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
