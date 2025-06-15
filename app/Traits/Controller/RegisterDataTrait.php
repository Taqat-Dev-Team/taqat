<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Controller;

use App\Http\Resources\General\SimpleDataResource;
use App\Http\Resources\General\NationalityResource;
use App\Http\Resources\General\IdTypeResource;
use App\Http\Resources\General\CountryResource;

use App\Models\Country;
use App\Models\UserType;
use App\Models\Nationality;
use App\Models\SocialStatus;
use App\Models\Government;
use App\Models\IdType;
use App\Models\State;

trait RegisterDataTrait
{
    public function getRegisterData() {
        return  [
            'user_types'         => SimpleDataResource::collection(UserType::Active()->get()) ,
            'nationalities'      => NationalityResource::collection(Nationality::Active()->get()) ,
            'social_statuses'    => SimpleDataResource::collection(SocialStatus::Active()->get()) ,
            'governments'        => SimpleDataResource::collection(Government::Active()->get()) ,
            'id_types'           => IdTypeResource::collection(IdType::Active()->get()),
            'states'             => SimpleDataResource::collection(State::Active()->get()) ,
            'countries'          => CountryResource::collection(Country::Active()->get()) ,

        ];

    }
}