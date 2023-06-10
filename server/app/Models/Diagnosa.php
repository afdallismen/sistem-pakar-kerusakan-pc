<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Konsultasi;
use App\Models\Kerusakan;

class Diagnosa extends Model
{
    use HasFactory;

    protected $fillable = [
        'konsultasi_id',
        'kerusakan_id',
        'cf',
    ];

    public function konsultasi(): BelongsTo
    {
        return $this->belongsTo(Konsultasi::class);
    }

    public function kerusakan(): BelongsTo
    {
        return $this->belongsTo(Kerusakan::class);
    }
}
