<?php

declare(strict_types = 1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Employer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request Request
     * 
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
