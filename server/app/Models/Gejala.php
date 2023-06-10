<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\GejalaKonsultasi;
use App\Models\Konsultasi;
use App\Models\Rule;

class Gejala extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function gejalaKonsultasis(): HasMany
    {
        return $this->hasMany(GejalaKonsultasi::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }

    public function konsultasis(): BelongsToMany
    {
        return $this->belongsToMany(Konsultasi::class, 'gejala_konsultasis');
    }
}
