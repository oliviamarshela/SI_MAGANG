<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pendaftaran extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "pendaftaran";
    protected $fillable = [
        'id','periode_id','user_id','nim','nama','prodi','sks_ditempuh','ipk','judul_pra_proposal','dosen_pembimbing_kp','nip','instansi_kp','status'
    ];
}
