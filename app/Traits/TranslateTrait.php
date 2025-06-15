<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits;

trait TranslateTrait
{
    use LanguageTrait;

    public function getNameAttribute() {
        return $this->getName();
    }
    public function getDescriptionAttribute() {
        return $this->getDescription();
    }


}