<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function users(){
        return $this->hasMany(User::class,'branch_id','id');
    }


    public function totalIncomeMovements(){
    return    IncomeMovement::query()->whereHas('user',function($q){
            $q->where('branch_id',$this->id);
        })->sum('amount')??0;
    }

    public function totalJobContracts(){
        return  jobContract::query()->whereHas('user',function($q){
            $q->where('branch_id',$this->id);
        })->sum('sallary')??0;
    }

    public function rooms(){
        return $this->hasMany(Room::class,'branch_id','id');
    }
    public function workSpaces(){
        return $this->hasMany(WorkSpace::class,'branch_id','id');
    }




    public function deskMangments(){
        return $this->hasMany(DeskMangment::class,'branch_id','id');
    }

    public function deskMangmentsCount(){
        return $this->deskMangments()->count();
    }

    public function sumRoomCapacity(){
        return $this->rooms()->sum('capacity');
    }

    public function MaxCapacity(){
        return $this->sumRoomCapacity()+$this->deskMangmentsCount();
    }


        public function deskMangmentsUserCount(){
        return $this->deskMangments()->whereNotNull('user_id')->count();
    }

    public function sumRoomUserCapacity(){
        return $this->rooms()->whereNotNull('user_id')->sum('capacity');
    }

    public function sumRegisteredCount(){
        return $this->sumRoomUserCapacity()+$this->deskMangmentsUserCount();
    }





}
