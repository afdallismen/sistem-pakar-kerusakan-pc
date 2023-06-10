<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Diagnosa;
use App\Models\Konsultasi;
use App\Models\Rule;

class Kerusakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'solusi',
    ];

    public function diagnosas(): HasMany
    {
        return $this->hasMany(Diagnosa::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }

    public function konsultasis(): BelongsToMany
    {
        return $this->belongsToMany(Konsultasi::class, 'diagnosas');
    }
}
