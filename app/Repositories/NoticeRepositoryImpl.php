<?php

namespace App\Repositories;

use App\Interfaces\NoticeRepository;
use App\Models\Notice;

class NoticeRepositoryImpl implements NoticeRepository
{

    public function store(array $request)
    {
        try {
            Notice::create([
                'notice' => $request['notice'],
                'session_id' => $request['session_id'],
            ]);
        } catch (\Exception $e) {
            throw new \Exception('Failed to save Notice. ' . $e->getMessage());
        }
    }

    /**
     * @param int $sessionId
     * @return mixed
     */
    public function getAll(int $sessionId)
    {
        return Notice::where('session_id', $sessionId)
            ->orderBy('id', 'desc')
            ->simplePaginate(3);
    }
}
