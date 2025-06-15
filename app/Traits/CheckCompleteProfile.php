<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits;

use Carbon\Carbon;

trait CheckCompleteProfile
{
    public function IsComplete($user) {
        if($user->id_type_id == 5 || $user->id_type_id == null || $user->id_type_id == 'null'){
            if($user->first_name == null || $user->middle_name == null || $user->last_name == null || $user->phone_code == null || $user->gender == null || $user->dob == null || $user->social_status_id == null || $user->job == null || $user->state_id == null || $user->city_id == null || $user->phone == null || $user->another_person_contact_name == null || $user->another_person_contact_phone == null || $user->another_person_phone_introduction == null ||  $user->email == null){
                return false;
            }else{
                return true;
            }
        }else{
            if($user->first_name == null || $user->middle_name == null || $user->last_name == null || $user->phone_code == null || $user->gender == null || $user->id_type_id == null || $user->id_number == null || $user->id_statue == null || $user->expire_id_date == null || $user->dob == null || $user->social_status_id == null || $user->job == null || $user->state_id == null || $user->city_id == null || $user->phone == null || $user->another_person_contact_name == null || $user->another_person_contact_phone == null || $user->another_person_phone_introduction == null ||  $user->email == null){
                return false;
            }else{
                return true;
            }
        }
    }
}
