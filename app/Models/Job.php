<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Translatable\HasTranslations;

class Job extends Model
{
    use HasFactory,Notifiable;
    protected $guarded = [];
    use HasTranslations;
    use SoftDeletes;
    protected $table = 'company_jobs';

    public $translatable = ['title', 'description', 'job_requirements','slug'];

    public function applyJobs()
    {
        return $this->hasMany(ApplyJob::class, 'job_id', 'id');
    }



    public function applyJobCount()
    {
        return $this->applyJobs()->count();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id')->withTrashed();
    }

    public function contracts()
    {
        return $this->hasMany(Contracts::class, 'job_id', 'id');
    }

    public function specializations()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id', 'id');
    }

    public function getStatus()
    {
        if ($this->status == 1) {
            return '<span class="badge badge-light">' . __('label.receive_orders') . '</span>';
        } elseif ($this->status == 2) {
            return '<span class="badge badge-secondary">'  . __('label.execute_order') . '</span>';
        } elseif ($this->status == 3) {
            return '<span class="badge badge-scuccess">' . __('label.completed') . '</span>';
        } elseif ($this->status == 4) {
            return '<span class="badge badge-danger">' . __('label.cancel') . '</span>';
        }
    }

    // public function
}
