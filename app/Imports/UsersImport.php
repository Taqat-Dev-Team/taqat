<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class UsersImport implements ToModel, WithHeadingRow
{

    public  $institution_Id;
    public $interest;
    public function __construct($institution_Id,$interest){
        $this->institution_Id=$institution_Id;
        $this->interest=$interest;

    }
    public function model(array $row)
    {


        $institution_Id=null;
        if ($this->institution_Id>0){
            $institution_Id=$this->institution_Id;
        }
         $user=User::query()->create([
            'email'=>$row['email'],
            'institution_Id'=>$institution_Id
        ]);


//         dd($user);
//         $user=User::query()->latest()->first();
         if ($this->interest) {
             $user->interests()->attach($this->interest);

         }
        return $user;

    }
}
