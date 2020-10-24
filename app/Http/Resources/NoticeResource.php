<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class NoticeResource extends Resource
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
            'file_path' => $this->file_path,
            'description' => $this->description,
            'school' => new SchoolResource($this->school),
        ];
    }
}
