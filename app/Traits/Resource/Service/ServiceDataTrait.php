<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Resource\Service;

use Carbon\Carbon;

trait ServiceDataTrait
{

    public function getData() {
        return [
            'id'     => $this->id ,
            'image'  => $this->image ,
            'name'   => $this->name
        ];
    }


}