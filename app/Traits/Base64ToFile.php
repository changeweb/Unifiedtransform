<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait Base64ToFile {
    /**
     * @param string $request
     * 
     * @return string
    */
    public function convert($request) : string {
        try {
            $photo = $request;  // your base64 encoded
            $photo = str_replace('data:image/png;base64,', '', $photo);
            $photo = str_replace('data:image/jpeg;base64,', '', $photo);
            $photo = str_replace('data:image/jpg;base64,', '', $photo);
            $photo = str_replace(' ', '+', $photo);
            $photoPath = '/photos/'.time().Str::random(10).'.'.'png';
            Storage::disk('public')->put($photoPath, base64_decode($photo));

            return $photoPath;
        } catch (\Exception $e) {
            throw new \Exception('Failed to save Photo. '.$e->getMessage());
        }
        
    }
}