<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'kategori' => $this->kategori,
            'harga' => (int) $this->harga,
            'deskripsi' => $this->deskripsi,
            'alergen' => $this->alergen,
            'halal' => $this->halal,
            'foto' => $this->foto ? asset('uploads/'.basename($this->foto)) : null,
        ];
    }
}
