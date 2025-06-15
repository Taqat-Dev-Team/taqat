<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits;

trait LanguageTrait
{

    public function getName()
    {
        $attr = "name_".app()->getLocale();
        return $this->$attr;
    }

    public function getDescription()
    {
        $attr = "description_".app()->getLocale();
        return $this->$attr;
    }


    public function getCapital($model)
    {
        $attr = "capital".app()->getLocale();
        return $model->$attr;
    }
    public function getValue($model)
    {
        $attr = "value_".app()->getLocale();
        return $model->$attr;
    }


}