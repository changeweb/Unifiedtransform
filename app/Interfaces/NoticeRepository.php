<?php

namespace App\Interfaces;

interface NoticeRepository
{

    /**
     * @param array $request
     * @return mixed
     */
    public function store(array $request);

    /**
     * @param int $sessionId
     * @return mixed
     */
    public function getAll(int $sessionId);
}
