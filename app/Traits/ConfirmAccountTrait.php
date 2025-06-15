<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits;

use Carbon\Carbon;

// events
use App\Events\SendVerificationCodeEvent;

trait ConfirmAccountTrait
{
    public function generate_code() {
        $digits = 4;
        return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
    }

    public function getExpireVerifiedAt() {
        return Carbon::now()->addHours(2);
    }

    public function sendVerificationCode($user) {
        event(new SendVerificationCodeEvent($user));
    }


}