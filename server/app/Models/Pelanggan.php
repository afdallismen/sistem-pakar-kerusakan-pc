<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Konsultasi;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nohp',
        'alamat',
    ];

    public function konsultasis(): HasMany
    {
        return $this->hasMany(Konsultasi::class);
    }
}
