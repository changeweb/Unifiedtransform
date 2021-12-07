<?php

namespace App\Repositories;

use App\Models\Notice;

class NoticeRepository {
    public function store($request) {
        try {
            Notice::create([
                'notice'        => $request['notice'],
                'session_id'    => $request['session_id'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to save Notice. '.$e->getMessage());
        }
    }

    public function getAll($session_id) {
        return Notice::where('session_id', $session_id)
                    ->orderBy('id', 'desc')
                    ->simplePaginate(3);
    }
}