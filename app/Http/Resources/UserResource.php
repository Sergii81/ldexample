<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email'         => $this->getEmail(),
            'created_at'    => $this->getCreatedAt()->format('Y-m-d H:i:s'),
            'updated_at'    => $this->getUpdatedAt()->format('Y-m-d H:i:s'),
            'profile'       => $this->getProfile() ? $this->getProfile()->getId() : null,
            'roles'         => $this->getRoles()
        ];
    }
}
