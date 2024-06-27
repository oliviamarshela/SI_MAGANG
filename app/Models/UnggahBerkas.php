<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class UnggahBerkas extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "unggah_berkas";
    protected $fillable = [
        'id','pendaftaran_id','user_id','permohonan_kp','surat_balasan_instansi','keterangan_konfirmasi'
    ];
}
