<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Gejala;
use App\Models\Konsultasi;

class GejalaKonsultasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'konsultasi_id',
        'gejala_id',
    ];

    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class);
    }

    public function konsultasi(): BelongsTo
    {
        return $this->belongsTo(Konsultasi::class);
    }
}
