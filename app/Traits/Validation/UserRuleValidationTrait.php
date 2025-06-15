<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Validation;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use App\Traits\Rule\CustomValidationRulesTrait;

// models
use App\Models\Nationality;
use App\Models\IdType;

trait UserRuleValidationTrait
{
    use CustomValidationRulesTrait;

    public function userTypeRules() {
        return [
            'is_applicant_another_person'      => ['required' , 'in:0,1'] ,
            'applicant_name'                   => ['required_if:is_applicant_another_person,1'],
            'applicant_phone'                  => $this->checkApplicantPhone(),

            'first_name'                       => ['required_if:is_applicant_another_person,0'],
            'reason'                           => ['sometimes'],
            'middle_name'                      => ['required_if:is_applicant_another_person,0'],
            'last_name'                        => ['required_if:is_applicant_another_person,0'],
            'nationality_id'                   =>  $this->checkNationality(),

            'id_number'                        => ['sometimes'],//$this->checkIdNumber() ,

            'gender'                           => ['required' , 'in:1,2'],
            'id_type_id'                       =>  $this->checkIdType(),
            // 'id_type_id'                       =>  $this->checkExistsWithActive('id_types' , 'id'),
            

            'id_statue'                        => $this->checkIdStatue(),
            'expire_id_date'                   => $this->checkExpireIdDate(),
//          'expire_id_date'                   => ['required' ,'date_format:Y-m-d' , 'after:today'],
            'social_status_id'                 => [$this->checkExistsWithActive('social_statuses' , 'id')],
            'number_of_family_members'         => ['required'],
            'job'                              => ['sometimes'],
            'dob'                              => ['required' ,'date_format:Y-m-d' , 'before:today'],

            'have_location_data'               => ['required' , 'in:0,1'] ,
            'state_id'                         => ['required' ,$this->checkExistsWithActive('states' , 'id') ],
            // 'city_id'                          => ['required' ,$this->checkExistsWithActive('cities' , 'id')->where('state_id' ,$this->data['state_id'])  ],
            'neighborhood'                     => ['max:250'],
            'street'                           => ['max:250'],
         //0   'home_number'                      => ['bail','required_if:have_location_data,1', 'max:250'],
            'build_number'                     => [ 'max:250'],
            'postal_code'                      => [ 'max:250'],
            'additional_number'                => [ 'max:13'  ],

            'another_person_contact_name'      => [ 'nullable','max:250'],
            'another_person_contact_phone'     => [],
            'another_person_phone_introduction'     => [],
            'can_multi_service'                => ['nullable'],

        ];

    }
    public function GovernmentTypeRules() {
        return [
            // 'username'                        => ['required' , $this->checkUniqueWithActive('users' , 'username')],
            'username'                        => [$this->checkUniqueWithActive('users' , 'username')],
            'government_id'                   => ['required' , $this->checkExistsWithActive('governments' , 'id') , $this->checkUniqueWithActive('users' , 'government_id')],
            'attachments.*'                     => ['required', 'max:3000', 'mimes:jpg,jpeg,png,doc,docs,pdf'],
            'accepted'                        => ['sometimes'],
        
        ];
    }
    public function CompanyTypeRules() {
        return [
            'username'                        => ['sometimes' , $this->checkUniqueWithActive('users' , 'username')],
            'company_name'                    => ['required' , 'max:250'],
            'id_number'                       => ['required' , $this->checkUniqueWithActive('users' , 'id_number')],
            'attachments.*'                     => ['required', 'max:3000', 'mimes:jpg,jpeg,png,doc,docs,pdf'],
            'accepted'                        => ['sometimes'],
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator)  {

            if($this->data['user_type_id'] == 1 && array_key_exists('nationality_id' ,$this->data ) && array_key_exists('id_type_id' , $this->data)) {
                $nationality = Nationality::find($this->data['nationality_id']);
                $id_type     = IdType::find($this->data['id_type_id']);
                if ($nationality && $id_type && (($nationality->is_saudi == 1 && $id_type->for_saudi == 0) || ($nationality->is_saudi == 0 && $id_type->for_not_saudi == 0) )) {
                    $validator->errors()->add('id_type_not_available_for_nationality', trans('error.id_type_not_available_for_nationality'));
                }
            }
        });
    }

    // help methods
    public function checkState() {
        if(isset($this->data['have_location_data']) && $this->data['have_location_data'] == 1) {
            return ['required' ,$this->checkExistsWithActive('states' , 'id') ];
        }else {
            return ['sometimes','nullable'];
        }
    }
    public function checkCity() {
        if(isset($this->data['have_location_data']) && $this->data['have_location_data'] == 1) {
            return ['required' ,$this->checkExistsWithActive('cities' , 'id')->where('state_id' ,$this->data['state_id'])  ];
        }else {
            return ['sometimes','nullable'];
        }
    }
    public function checkAdditionalNumber() {
        if(isset($this->data['have_location_data']) && $this->data['have_location_data'] == 1) {
            return ['required' ,'digits_between:5,13'  ];
        }else {
            return ['sometimes','nullable'];
        }
    }
    public function checkNationality() {
        if(isset($this->data['nationality_id']) && !is_null($this->data['nationality_id']) && $this->data['nationality_id'] != -1) {
            return ['required' ,$this->checkExistsWithActive('nationalities' , 'id') ];
        }else {
            return ['sometimes','nullable'];
        }
    }
    public function checkIdNumber() {

        if(isset($this->data['nationality_id']) && !is_null($this->data['nationality_id']) && $this->data['nationality_id'] != -1 && $this->data['register_type'] != 'iam') {
            return ['required' , $this->checkUniqueWithActive('users' , 'id_number')];
        }else {
            return ['sometimes','nullable'];
        }
    }
    public function checkApplicantPhone() {
        if(isset($this->data['is_applicant_another_person']) && $this->data['is_applicant_another_person'] == 1) {
            return ['required' ,'digits_between:5,13' ];
        }else {
            return ['sometimes','nullable'];
        }
    }

    public function checkIdType(){
        if(isset($this->data['nationality_id']) && !is_null($this->data['nationality_id']) && $this->data['nationality_id'] != -1 && $this->data['id_type_id'] != 'null') {
            return ['required'];

        }else {
            return ['sometimes','nullable'];
        }

    }

    public function checkIdStatue(){
        if(isset($this->data['nationality_id']) && !is_null($this->data['nationality_id']) && $this->data['nationality_id'] != -1 && $this->data['id_type_id'] != 5 && $this->data['id_type_id'] != null) {
            return ['required' , 'in:0,1'];
        }else {
            return ['sometimes','nullable'];
        }
    }


    public function checkExpireIdDate(){
        if(isset($this->data['nationality_id']) && !is_null($this->data['nationality_id']) && $this->data['nationality_id'] != -1 && $this->data['id_type_id'] != 5 && $this->data['id_type_id'] != null) {
            return   ['required' ,'date_format:Y-m-d'];
        }else {
            return ['sometimes','nullable'];
        }

    }

}