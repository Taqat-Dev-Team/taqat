<?php

namespace App\Jobs;

use App\Notifications\JobCreatedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendJobNotificationJob implements ShouldQueue
{
    protected $users;
    protected $job;

    /**
     * Create a new job instance.
     *
     * @param $users
     * @param $project
     */
    public function __construct($users, $job)
    {
        $this->users = $users;
        $this->job = $job;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        Notification::send($this->users, new JobCreatedNotification($this->job));
    }
}
