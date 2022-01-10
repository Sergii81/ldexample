<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->getId(),
            'name'          => $this->getName(),
            'created_at'    => $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at'    => $this->getUpdatedAt()->format('Y-m-d H:i:s'),
        ];
    }
}
