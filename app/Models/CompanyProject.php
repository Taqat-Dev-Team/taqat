<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class CompanyProject extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasTranslations;

    protected $guarded=[];
    public $translatable = ['title','description','received_required','slug'];


    public function specializations(){
        return $this->belongsToMany(Specialization::class,'specialization_company_project','project_company_id','specialization_id','id','id');
    }

    public  function  company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }


    public function myStones(){
        return $this->hasMany(MyStone::class,'project_id','id')->orderby('id','desc');
    }

    public function offers(){
        return $this->hasMany(Offer::class,'project_id','id');
    }

    public function attachments(){
        return $this->hasMany(AttachmentProjectCompany::class,'project_company_id','id');
    }

    public function reviews(){
        return $this->hasMany(ProjectReview::class,'project_id','id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function latestReview()
    {
        return $this->reviews()->where('company_id',auth('company')->id())->latest()->first();
    }

    public function compnayRatting(){
        return $this->hasOne(UserProjectRatting::class,'project_id','id');
    }

    public function userRattings(){
        return $this->hasOne(ProjectReview::class,'project_id','id');
    }

    public function countOffer(){
        return $this->offers()->count();
    }
    public function avgOffer(){
        return round($this->offers()->avg('cost'),2);
    }



    public function myOffer(){
      return $this->offers()->where('user_id',auth()->id())->first();
    }

    public function getStatus(){
        if($this->status==1)
        {
            return '<span class="badge badge-light">'.__('label.receive_orders').'</span>';
        }elseif($this->status==2) {
            return '<span class="badge badge-secondary">'  .__('label.execute_order').'</span>';

        }elseif($this->status==3) {
            return '<span class="badge badge-scuccess">'.__('label.completed').'</span>';

        }
        elseif($this->status==4) {
            return '<span class="badge badge-danger">'.__('label.cancel'). '</span>';

        }
    }

    public function checkOffer(){
        return boolval($this->offers()->where('user_id',auth()->id())->first());
    }
}
