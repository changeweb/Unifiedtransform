<?php

namespace App\Listeners;

use App\Events\StudentInfoUpdateRequested;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\User\HandleUser;

class UpdateStudentInfo
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StudentInfoUpdateRequested  $event
     * @return void
     */
    public function handle(StudentInfoUpdateRequested $event)
    {
        try{
            HandleUser::updateStudentInfo($event->request,$event->student_id);
            return true;
        } catch(\Exception $ex) {
            Log::info('Failed to update Student information, Id: '.$event->user_id);
            return false;
        }
    }
}
