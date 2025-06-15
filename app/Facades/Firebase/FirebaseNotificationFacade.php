<?php
/**
 * Created by PhpStorm.
 * User: Al
 * Date: 13/6/2020
 * Time: 05:26 م
 */

namespace App\Facades\Firebase;


use Illuminate\Support\Facades\Facade;

class FirebaseNotificationFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return "firebase-notification-Service";
    }
}

