<?php

use Illuminate\Http\Resources\Json\JsonResource;

class UserRequestResource extends JsonResource
{
    public function toArray(\Illuminate\Http\Request $request)
    {
        return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
