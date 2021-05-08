<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SectionResource extends Resource
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
            'section_number' => $this->section_number,
            'room_number' => $this->room_number,
            'class' => new ClassResource($this->class),
        ];
    }
}
