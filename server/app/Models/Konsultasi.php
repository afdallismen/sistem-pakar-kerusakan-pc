<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Diagnosa;
use App\Models\Kerusakan;
use App\Models\Pelanggan;
use App\Models\GejalaKonsultasi;
use App\Models\Gejala;

class Konsultasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'deskripsi',
        'pelanggan_id',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function diagnosas(): HasMany
    {
        return $this->hasMany(Diagnosa::class);
    }

    public function gejala_konsultasis(): HasMany
    {
        return $this->hasMany(GejalaKonsultasi::class);
    }

    public function kerusakans(): BelongsToMany
    {
        return $this->belongsToMany(Kerusakan::class, 'diagnosas');
    }

    public function gejalas(): BelongsToMany
    {
        return $this->belongsToMany(Gejala::class, 'gejala_konsultasis');
    }
}
