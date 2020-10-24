<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class HomeworkResource extends Resource
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
            'file_path' => $this->file_path,
            'section' => new SectionResource($this->section),
            'teacher' => new UserResource($this->teacher),
        ];
    }
}
