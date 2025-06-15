<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Resource\Order;

use App\Http\Resources\Service\ServiceResource;
use App\Http\Resources\General\SimpleDataResource;
use App\Http\Resources\Order\OrderReviewResource;
use Carbon\Carbon;

trait OrderDataTrait
{

    public function getData() {
        return [
            'id'        => $this->id ,
            'service'   => new ServiceResource($this->service),
            'status'    => new SimpleDataResource($this->get_status),
            'can_reply' => $this->get_status && $this->get_status->can_replay != 0 && $this->can_replay != 0 ,
            'date'      => $this->created_at,
            'reviews'      => $this->reviews ,
        ];
    }


}