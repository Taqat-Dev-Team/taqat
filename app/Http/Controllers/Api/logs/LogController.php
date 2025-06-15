<?php

namespace App\Http\Controllers\Api\logs;

use App\Http\Controllers\Controller;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as FacadesLog;

class LogController extends Controller
{
    public function checkLogin(Request $request)
    {

            foreach ($request->users as $userData) {
                $user = User::where('mobile',$userData['username'])->orwhere('code_internet',$userData['username'])->first();

                // Check if user exists and if userData['is_active'] is true
                if ($userData['active']) {
                    // Check if there's already a log entry for the current user today
                    $user=User::query()->where('mobile',$userData['username'])->orwhere('code_internet',$userData['username'])->first();

                    $existingLog = Log::where('mobile',$userData['username'])
                            ->where('date', now()->toDateString())
                            ->first();
                    if ($existingLog) {
                        // Update timeout for the existing log
                        $existingLog->update([
                            'time_out' => now()->toTimeString(),
                            'duration' => Carbon::parse($existingLog->time_in)->diffInMinutes(now()),
                            'ip_address' => $request->ip(),
                            'mobile'=>$userData['username'] // Set current time as timeout
                        ]);
                    } else {

                        Log::create([
                            'data'=>'stte',
                            'user_id' => $user?->id,
                            'ip_address' => $request->ip(),
                            'date' => now()->toDateString(),
                            'mobile'=>$userData['username'], // Set current time as timeout
                            'time_in' => now()->toTimeString(), // Set current time as time_in
                            'time_out' => now()->toTimeString(), // Set initial timeout as current time (or null if not available)
                        ]);

                }
            }
        }
    }

}
