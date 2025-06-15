<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Image;

use App\Models\Gallery;

trait FlagTrait
{

    public function get_flag()
    {
        return $this->belongsTo(Gallery::class, 'flag_id');
    }

    public function getFlagAttribute() {
        return is_null($this->flag_id) ? getPath($this->getTable(), true) :$this->get_flag->src ;
    }

}