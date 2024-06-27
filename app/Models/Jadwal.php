<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Jadwal extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "jadwal";
    protected $fillable = [
        'id','periode_id','tanggal','jam','tipe'
    ];

    protected $dates = ['tanggal'];
}
