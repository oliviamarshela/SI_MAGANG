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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('periode_id');
            $table->uuid('user_id');
            $table->string('nim');
            $table->string('nama');
            $table->string('prodi');
            $table->string('sks_ditempuh');
            $table->string('ipk');
            $table->string('judul_pra_proposal')->nullable();
            $table->string('dosen_pembimbing_kp')->nullable();
            $table->string('nip')->nullable();
            $table->string('instansi_kp')->nullable();
            $table->enum('status',['diterima','perbaikan','diunggah'])->nullable();
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
        Schema::dropIfExists('pendaftarans');
    }
};
