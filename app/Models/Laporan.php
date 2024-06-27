<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Laporan extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "laporan";
    protected $fillable = [
        'id','pendaftaran_id','user_id','file','keterangan'
    ];

}
