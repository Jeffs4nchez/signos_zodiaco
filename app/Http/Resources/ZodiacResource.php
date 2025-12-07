<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Recurso RESTful para representar un Signo Zodiacal
 * Extiende JsonResource para seguir estándares REST
 */
class ZodiacResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this['name'],
            'name' => $this['name'],
            'symbol' => $this['symbol'],
            'date_range' => $this['date_range'],
            'element' => $this['element'],
            'description' => $this['description'],
            'compatible_signs' => $this['compatible_signs'],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
