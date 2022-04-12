<?php

namespace App\Repositories;

use App\Models\SchoolSession;
use App\Interfaces\SchoolSessionInterface;

class SchoolSessionRepository implements SchoolSessionInterface {
    public function getLatestSession() {
        $school_session = SchoolSession::latest()->first();
        if($school_session){
            return $school_session;
        } else {
            return (object) ['id' => 0];
        }
    }

    public function getAll() {
        return SchoolSession::get();
    }

    public function getPreviousSession() {
        $lastTwoSessions = SchoolSession::orderBy('id', 'desc')
                        ->take(2)
                        ->get()
                        ->toArray();
        return (count($lastTwoSessions) < 2)? [] : $lastTwoSessions[1];
    }

    public function create($request) {
        try {
            SchoolSession::create($request);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create School Session. '.$e->getMessage());
        }
    }

    public function browse($request) {
        try {
            if(session()->has('browse_session_id')
                && ($request['session_id'] == $this->getLatestSession()->id)
            ) {
                session()->forget(['browse_session_id', 'browse_session_name']);
            } else {
                session(['browse_session_id' => $request['session_id']]);
                session(['browse_session_name' => $this->getSessionById($request['session_id'])->session_name]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Failed to set School Session for browsing. '.$e->getMessage());
        }
    }

    public function getSessionById($id) {
        return SchoolSession::find($id);
    }
}