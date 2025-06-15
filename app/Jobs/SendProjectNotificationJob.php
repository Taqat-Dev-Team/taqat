<?php

namespace App\Jobs;

use App\Notifications\newProjectNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendProjectNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    protected $users;
    protected $project;

    /**
     * Create a new job instance.
     *
     * @param $users
     * @param $project
     */
    public function __construct($users, $project)
    {
        $this->users = $users;
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Send notifications to users
//        Notification::send($this->users, new newProjectNotification($this->project));
    }
}
