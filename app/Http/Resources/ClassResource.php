<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ClassResource extends Resource
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
            'class_number' => $this->class_number,
            'school' => new SchoolResource($this->school),
        ];
    }
}
