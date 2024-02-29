<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Events\AccountCreated;
use App\Events\AccountUpdated;
use App\Events\AccountDeleted;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog;

class ChangeLogListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the "accountCreated" event.
     */
    public function handleAccountCreated(AccountCreated $event)
    {
        $this->createChangeLog($event->user->id, $event->user->id, 'created');
    }

    /**
     * Handle the "accountUpdated" event.
     */
    public function handle(AccountUpdated $event)
    {
        $this->createChangeLog(Auth::id(), $event, 'Updated');
    }

    /**
     * Handle the "accountDeleted" event.
     */
    public function handleAccountDeleted(AccountDeleted $event)
    {
        $this->createChangeLog(Auth::id(), $event->user->id, 'Deleted');
    }

    /**
     * Create a new ChangeLog instance.
     */
    protected function createChangeLog($operatorId, $event, $operationType)
    {
        
        $changeLog = new ActivityLog();
        $changeLog->operator_id = $operatorId;
        $changeLog->target_id = $event->old_data['id'];
        $changeLog->model = User::class;
        $changeLog->model_id = $event->old_data['id'];
        $changeLog->operation_type = $operationType;
        //dd(array("id" => $event->old_data->id, "surname" => $event->old_data->surname, "given_name" => $event->old_data->given_name, "image_path" => $event->old_data->image_path, "image_file_name" => $event->old_data->image_file_name, "birth_day" => $event->old_data->birth_day, "phone" => $event->old_data->phone, "email" => $event->old_data->email));
        $changeLog->original_data = json_encode($event->old_data);
        $changeLog->new_data = json_encode($event->new_data);
        //dd($changeLog->old_data, $changeLog->new_data);
        $changeLog->save();
    }
}
