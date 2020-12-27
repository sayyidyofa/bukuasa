<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class FakturResource extends JsonResource
{
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
