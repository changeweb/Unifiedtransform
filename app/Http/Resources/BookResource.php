<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BookResource extends Resource
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
            'img_path' => $this->img_path,
            'about' => $this->about,
            'price' => $this->price,
            'class' => new ClassResource($this->class),
        ];
    }
}
