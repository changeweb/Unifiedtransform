<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Http\Request;

class StudentInfoUpdateRequested
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $request;
    public $student_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Request $request, int $student_id)
    {
        $this->request = $request;
        $this->student_id = $student_id;
    }
}
