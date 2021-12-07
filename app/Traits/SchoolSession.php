<?php

namespace App\Traits;

trait SchoolSession {
    /**
     * @param string $request
     * 
     * @return string
    */
    public function getSchoolCurrentSession() {
        $current_school_session_id = 0;

        if (session()->has('browse_session_id')){
            $current_school_session_id = session('browse_session_id');
        } else {
            $latest_school_session = $this->schoolSessionRepository->getLatestSession();

            if($latest_school_session){
                $current_school_session_id = $latest_school_session->id;
            }
        }

        return $current_school_session_id;
    }
}