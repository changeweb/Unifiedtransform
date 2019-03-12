<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CourseResource extends Resource
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
            'course_name' => $this->course_name,
            'course_time' => $this->course_time,
            'teacher' => new UserResource($this->teacher),
            'section' => new SectionResource($this->section),
        ];
    }
}
