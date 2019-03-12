<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class GradeResource extends Resource
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
            'marks' => $this->marks,
            //'exam_name' => $this->exam_name,
            'course' => new CourseResource($this->course),
            'teacher' => new UserResource($this->teacher),
            'student' => new UserResource($this->student),
        ];
    }
}
