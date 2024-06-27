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
        Schema::create('unggah_berkas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pendaftaran_id');
            $table->uuid('user_id');
            $table->string('permohonan_kp');
            $table->string('surat_balasan_instansi')->nullable();;
            $table->string('keterangan_konfirmasi')->nullable();;
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
        Schema::dropIfExists('unggah_berkas');
    }
};
