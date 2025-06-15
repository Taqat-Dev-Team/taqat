<?php
/**
 * Created by PhpStorm.
 * User: HP15
 * Date: 04/08/19
 * Time: 10:08 ص
 */

namespace App\Traits\Controller;

// controllers
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\FormServiceController;
use App\Http\Controllers\Admin\ComplaintCategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\NationalityController;
use App\Http\Controllers\Admin\GovernmentController;
use App\Http\Controllers\Admin\OrderStatusController;
use App\Http\Controllers\Admin\IdTypeController;
use App\Http\Controllers\Admin\SocialStatusController;
use App\Http\Controllers\Admin\OrderEventController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ContactUsController;

trait PermissionKeyWithController
{
    public function getPermissionKeyWithController($controller)
    {
        $result = [
            ServiceController::class => 'service',
            EventController::class => 'event',
            ComplaintCategoryController::class => 'complaint_categories',
            FormServiceController::class => 'form',
            CountryController::class => 'country',
            StateController::class => 'state',
            CityController::class => 'city',
            NationalityController::class => 'nationality',
            GovernmentController::class => 'government',
            OrderStatusController::class => 'order_status',
            IdTypeController::class => 'id_type',
            SocialStatusController::class => 'social_status',
            CountryController::class => 'gallery',
            OrderEventController::class => 'order_event',
            OrderController::class => 'order',
            UserController::class => 'user',
            ContactUsController::class => 'contacts',
            AdminController::class => 'admin',
        ];
        return array_key_exists($controller, $result) ? $result[$controller] : '';
    }

    public function getKeyWithNumberOption($number)
    {
        switch ($number) {
            case 1 :
            case 2 :
            case 4 :
                return "edit";
            case 3:
                return "delete";
            default :
                return "edit";
        }
    }
}
