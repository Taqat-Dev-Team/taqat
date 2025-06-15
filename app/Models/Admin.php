<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions; // Import this class

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    protected $guarded = [];

    protected static $logAttributes = [
        'name', 'email', 'last_login_at',
    ];

    protected static $logName = 'admin';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Admin model has been {$eventName}";
    }

    // Implement the getActivitylogOptions method
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logAll()
            ->useLogName(self::$logName);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function hasAbility($permissions)
    {
        $role = $this->role;

        if (!$role) {
            return false;
        }

        // if ($this->is_supper) {
        //     return true;
        // }

        foreach ($role->permissions as $permission) {
            if ($this->is_supper) {
                return true;
            }
            if (is_array($permissions) && in_array($permission, $permissions)) {

                return true;
            } else if (is_string($permissions) && strcmp($permissions, $permission) == 0) {
                return true;
            }
        }

        return false;
    }

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }

    public function getAttachment()
    {
        return $this->image ? asset('public/files/' . $this->image) : asset('assets/default.png');
    }
}
