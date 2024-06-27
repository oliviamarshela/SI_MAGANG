<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Periode extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "periode";
    protected $fillable = [
        'id','nama','status'
    ];
}
