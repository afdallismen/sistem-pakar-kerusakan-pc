<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GejalaKonsultasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'konsultasi_id',
        'gejala_id',
    ];
}
