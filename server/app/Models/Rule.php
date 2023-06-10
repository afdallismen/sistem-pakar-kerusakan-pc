<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Kerusakan;
use App\Models\Gejala;

class Rule extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'mb',
        'md',
        'kerusakan_id',
        'gejala_id',
    ];

    public function kerusakan(): BelongsTo
    {
        return $this->belongsTo(Kerusakan::class);
    }

    public function gejala(): BelongsTo
    {
        return $this->belongsTo(Gejala::class);
    }
}
