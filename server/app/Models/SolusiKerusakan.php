<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolusiKerusakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'deskripsi',
        'kerusakan_id',
    ];
}
