<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histori_penginap extends Model
{
    use HasFactory;
    protected $table = 'histori_penginap';
    protected $fillable = [
        "id_penginap",
        "id_kamar",
        "durasi",
        "check_in",
        "check_out",
        "total_bayar",
        "waktu",
        "penalty"
    ];
}
