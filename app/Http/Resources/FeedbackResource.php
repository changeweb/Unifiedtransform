<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class FeedbackResource extends Resource
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
            'teacher' => new UserResource($this->teacher),
            'student' => new UserResource($this->student),
        ];
    }
}
