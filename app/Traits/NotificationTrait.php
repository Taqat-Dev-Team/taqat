<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits;

use App\Notifications\MakeOrderNotification;
use App\Notifications\AddNoteToUserNotification;
use App\Notifications\ChangeOrderStatusNotification;

trait NotificationTrait
{

    public function getTitleAndSubTitleNotification($type ,$data , $lang)
    {
        $sub_title = "";
        switch ($type) {
            case MakeOrderNotification::class :
                $title = trans('notification.order_details', $data , $lang);
                $sub_title = trans('notification.make_order' ,$data, $lang);
                break;

            case AddNoteToUserNotification::class :
                $title = trans('notification.order_note', $data , $lang);
                $sub_title = $data['note'];
                break;

            case ChangeOrderStatusNotification::class :
                $data['status'] = json_decode($data['get_status'], true)[$lang];
                $title = trans('notification.order_details', $data , $lang);
                $sub_title = trans('notification.change_status_to', $data , $lang);
                break;

        }
        return [
            'title'     => $title ,
            'sub_title' => $sub_title,
        ];
    }

}