<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penginap extends Model
{
    use HasFactory;
    protected $table = 'penginap';
    protected $fillable = ['nama_penginap', 'telepon', 'id_kamar', 'durasi', 'check_in'];
}
