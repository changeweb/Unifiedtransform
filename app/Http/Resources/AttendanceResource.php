<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class AttendanceResource extends Resource
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
            'present' => $this->present,
            'created_at' => (string) $this->created_at,
            'student' => new UserResource($this->student),
            //'section' => new SectionResource($this->section)
        ];
    }
}
