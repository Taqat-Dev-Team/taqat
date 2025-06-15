<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Controller\Order;

use App\Http\Resources\General\SimpleDataResource;
use App\Http\Resources\General\NationalityResource;
use App\Http\Resources\General\IdTypeResource;
use Illuminate\Support\Facades\DB;

use App\Models\Order;
use App\Traits\Controller\StateWithServiceOrderTrait;

trait OrderDetailsTrait
{
    use StateWithServiceOrderTrait;

    public function getOrderDetails($id)
    {
        $order = Order::with(['service',
            'user.user_type', 'user.nationality', 'user.id_type', 'user.social_status', 'user.state', 'user.city',
            'elements.element','order_notes','reviews'])->find($id);

        $order->elements->map(function ($value) {
            $value->get_element_text = $this->getOrderElementText($value);
            return;
        });
        optional($order->elements->where('element.option_pointer', '=', 'complaint_categories')->first())->load('complaint_category');
        optional($order->elements->where('element.option_pointer', '=', 'states')->first())->load('state');
        optional($order->elements->where('element.option_pointer', '=', 'cities')->first())->load('city');
        optional($order->elements->where('element.type', '=', 'file')->first())->load('file');


        return $order;
    }

    public function getRemoteOrders($request)
    {
        $admin = auth()->guard('admin')->user();

        $state_with_service = $this->getStateWithServiceOrder($admin, $request->state_id, $request->serviceId);

        $orders = Order::with(['user','reviews', 'service:id,name', 'get_status', 'state', 'city'])
            ->City($request->city_id)
            ->State($state_with_service['state_ids'], $state_with_service['show_havent_state'])
            ->Status($request->status_id)
            ->Service($state_with_service['serviceIds'])
            ->FilterDate('orders.created_at', $request->start_date, $request->end_date);

        return $orders;
    }

//////////////////// New Orders //////////////////
    public function getRemoteNewOrders($request)
    {
        $admin = auth()->guard('admin')->user();
        $state_with_service = $this->getStateWithServiceOrder($admin, $request->state_id, $request->serviceId);

        $orders = Order::with(['user', 'service:id,name', 'get_status', 'state', 'city'])
            ->whereHas('order_note',function ($q){
//                $q->where('note_type','App\User');
            })
            ->with(['order_note'=>function($q){
//                $q->where('note_type','App\User');

            }])
            ->City($request->city_id)
            ->State($state_with_service['state_ids'], $state_with_service['show_havent_state'])
            ->Status($request->status_id)
            ->Service($state_with_service['serviceIds'])
            ->FilterDate('orders.created_at', $request->start_date, $request->end_date);



        return $orders;
    }

    // help
    public function getOrderElementText($order_element)
    {

        switch ($order_element->element->option_pointer) {
            case "complaint_categories" :
                return optional($order_element->complaint_category)->name;
            case "states" :
                return optional($order_element->state)->name;
            case "cities" :
                return optional($order_element->city)->name;
            default :
                if ($order_element->element->type == "radiobutton") {
                    switch ($order_element->value) {
                        case "1" :
                            return __('admin.yes');
                        case "2" :
                            return __('admin.no');
                    }
                }
                if ($order_element->element->type == "checkbox") {
                    switch ($order_element->value) {
                        case "1" :
                            return __('admin.yes');
                        case "2" :
                            return __('admin.no');
                    }
                }


                return $order_element->value;
        }
    }
}
