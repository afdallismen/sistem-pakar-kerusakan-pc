<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PelangganResource;
use App\Http\Resources\DiagnosaResource;
use App\Http\Resources\GejalaKonsultasiResource;
use App\Http\Resources\KerusakanResource;
use App\Http\Resources\GejalaResource;

class KonsultasiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'deskripsi' => $this->deskripsi,
            'pelanggan_id' => $this->pelanggan_id,
            'pelanggan' => new PelangganResource($this->pelanggan),
            'diagnosas' => DiagnosaResource::collection($this->diagnosas),
            'gejala_konsultasis' => GejalaKonsultasiResource::collection($this->gejala_konsultasis),
            'kerusakans' => KerusakanResource::collection($this->kerusakans),
            'gejalas' => GejalaResource::collection($this->gejalas),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
