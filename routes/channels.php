<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/


Broadcast::channel('App.Models.Admin.{id}', function ($user, $id) {
    return true;
});
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


Broadcast::channel('project.{projectId}', function ($user, $projectId) {
    return true; // Customize this to check if the user can listen to this channel
});


Broadcast::channel('job.{jobId}', function ($user, $projectId) {
    return true; // Customize this to check if the user can listen to this channel
});
