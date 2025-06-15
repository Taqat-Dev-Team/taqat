<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Controller;

trait ExecuteOptionsTrait
{

    public function pointer_to_options($more_options) {

        $options = [
            'active'          =>  ['id' => 1 , 'name' => trans('admin.change_status_to_active')] ,
            'not_active'      =>  ['id' => 2 , 'name' => trans('admin.change_status_to_deactive')],
            'delete'          =>  ['id' => 3 , 'name' => trans('admin.delete')],
            'confirm_account' =>  ['id' => 4 , 'name' => trans('admin.confirm_account')],
        ];
        foreach($more_options as $key=>$value) {
            switch ($key) {
                case 'order_statuses' :
                    foreach ($value as $order_status) {
                        $options['status-'.$order_status->id] = ['id' => 'status-'.$order_status->id , 'name' => trans('admin.change_status_to' , ['name' => $order_status->name]) ];
                    }
                    break;
            }
        }
        return $options;
    }

    public function options($allowed , $more_options = [] ) {
        return json_encode(array_filter(
            $this->pointer_to_options($more_options),
            function ($key) use ($allowed) {
                return in_array($key, $allowed) || strpos($key, 'status') !== false ;
            },
            ARRAY_FILTER_USE_KEY
        ));
    }



}