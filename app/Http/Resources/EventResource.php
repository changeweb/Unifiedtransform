<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class EventResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'class' => new ClassResource($this->class),
        ];
    }
}
