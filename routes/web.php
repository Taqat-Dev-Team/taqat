<?php

use App\Events\NewOrderCreated;
use App\Events\NewOrderReceived;
use App\Http\Controllers\Front\AttendanceController;
use App\Http\Controllers\Front\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BillExchange\BillExchangeController;
use App\Http\Controllers\Front\Auth\AuthContoller;
use App\Http\Controllers\Front\Mystone\MystoneController;
use App\Http\Controllers\Front\Chats\ChatController;
use App\Http\Controllers\Front\Clock\ClockController;
use App\Http\Controllers\Front\CompanyProjects\CompanyProjectController;
use App\Http\Controllers\Front\Constracts\ContstractController;
use App\Http\Controllers\Front\Dashbord\DashbordController;
use App\Http\Controllers\Front\IncomeMoveMent\IncomeMoveMentController;
use App\Http\Controllers\Front\JobConstracts\JobConstranctController;
use App\Http\Controllers\Front\JobInterviews\JobInterviewsController;
use App\Http\Controllers\Front\Jobs\JobController;
use App\Http\Controllers\Front\MyProjects\MyProjectController;
use App\Http\Controllers\Front\Offers\OffersController;
use App\Http\Controllers\Front\Orders\OrderController as OrdersOrderController;
use App\Http\Controllers\Front\Projects\ProjectController;
use App\Http\Controllers\Front\ScientificCertificates\ScientificCerificateController;
use App\Http\Controllers\Front\TrainingCourses\TraniningCoursesContoller;
use App\Http\Controllers\Front\Withdraws\WithdrawsController;
use App\Http\Controllers\Front\WorkExperiences\WorkExperiencesController;
use App\Http\Controllers\Front\Profile\ProfileController;
use App\Http\Controllers\Front\Restaurants\Products\ProductController as ProductsProductController;
use App\Http\Controllers\Front\Restaurants\RestaurantController;
use App\Http\Controllers\Front\Services\ServiceController;
use App\Http\Controllers\Front\Wallets\WalletController;
use App\Http\Controllers\Restaurants\Auth\LoginController;
use App\Http\Controllers\Restaurants\IndexController;
use App\Http\Controllers\Restaurants\Orders\OrderController;
use App\Http\Controllers\Restaurants\Products\ProductController;
use App\Http\Controllers\Restaurants\Reports\ReportController;
use App\Models\Admin;
use App\Models\Attendance;
use App\Models\BillExchange;
use App\Models\Branch;
use App\Models\Constant;
use App\Models\Invoice;
use App\Models\Log;
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Models\wallet;
use App\Notifications\NewOrderNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/logs', function () {




    return  Invoice::query()->where('user_id', 955)->get();
});

Route::get('/update_wallet', function () {


    wallet::query()->where('user_id', 10)->update([
        'balance' => 7
    ]);
});




Route::get('storage_link', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');

    dd('as');
});
Route::get('clear', function () {
    \Illuminate\Support\Facades\Artisan::call('config:clear');
    \Illuminate\Support\Facades\Artisan::call('config:cache');
    \Illuminate\Support\Facades\Artisan::call('view:clear');

    dd('as');
});
Route::get('sentry', function () {
    $order = Order::query()->with('users')->orderby('id', 'desc')->first();
    event(new NewOrderReceived($order));
    return 'Event fired!';
});
Route::get('/login-test', function () {
    Auth::login(Admin::first());
    return 'تم تسجيل الدخول كأدمن';
});


Route::get('/sericve_test', function () {
    return
        Service::query()->get();
});

Route::get('/loggin', function () {
    $user = User::query()->first();

    auth()->login($user);
});


Route::group(['middleware' => 'guest', 'prefix' => 'restaurants'], function () {

    Route::get('login', [LoginController::class, 'getLogin'])->name('restaurants.login');
    Route::post('post_login', [LoginController::class, 'postLogin'])->name('restaurants.login.post');
});



Route::group(['middleware' => 'guest', 'prefix' => 'restaurants'], function () {

    Route::get('login', [LoginController::class, 'getLogin'])->name('restaurants.login');
    Route::post('post_login', [LoginController::class, 'postLogin'])->name('restaurants.login.post');
});

Route::group(['middleware' => 'auth:restaurant', 'prefix' => 'restaurants'], function () {
    Route::get('/home', [IndexController::class, 'index'])->name('restaurants.index');

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/', [OrderController::class, 'index'])->name('restaurants.orders.index');
        Route::get('/getIndex', [OrderController::class, 'getIndex'])->name('restaurants.orders.getIndex');
        Route::post('/store', [OrderController::class, 'store'])->name('restaurants.orders.store');
        Route::post('/update', [OrderController::class, 'update'])->name('restaurants.orders.update');
        Route::post('/delete', [OrderController::class, 'delete'])->name('restaurants.orders.delete');
        Route::post('/update_status', [OrderController::class, 'updateStatus'])->name('restaurants.orders.updateStatus');
        Route::post('show/', [OrderController::class, 'show'])->name('restaurants.orders.show');
        Route::get('restaurants/orders/export', [OrderController::class, 'exportExcel'])
            ->name('restaurants.orders.exportExcel');
    });
        Route::group(['prefix' => 'reports'], function () {
        Route::get('/', [ReportController::class, 'index'])->name('restaurants.reports.index');
        Route::get('/getIndex', [ReportController::class, 'getIndex'])->name('restaurants.reports.getIndex');
        Route::get('/exportExcel', [ReportController::class, 'exportExcel'])->name('restaurants.reports.exportExcel');

});



    Route::group(['prefix' => 'products'], function () {

        Route::get('/', [ProductController::class, 'index'])->name('restaurants.products.index');
        Route::get('/getIndex', [ProductController::class, 'getIndex'])->name('restaurants.products.getIndex');
        Route::post('/store', [ProductController::class, 'store'])->name('restaurants.products.store');
        Route::post('/update', [ProductController::class, 'update'])->name('restaurants.products.update');
        Route::post('/delete', [ProductController::class, 'delete'])->name('restaurants.products.delete');
        Route::post('/update_status', [ProductController::class, 'updateStatus'])->name('restaurants.products.updateStatus');
    });
});
Route::get('/createMeeting', [\App\Http\Controllers\Companies\MeetController::class, 'createMeeting'])->name('createMeeting');
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['middleware' => 'guest'], function () {

            Route::get('/login', [AuthContoller::class, 'getLogin'])->name('login');
            Route::post('user/post_login', [AuthContoller::class, 'postlogin'])->name('front.login.postlogin');
            Route::get('/register', [AuthContoller::class, 'getRegister'])->name('front.register.get');
            Route::post('user/post_register', [AuthContoller::class, 'postRegister'])->name('front.register.post');
            Route::get('forget-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('front.password.request');
            Route::post('forget-password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
            Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
            Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
        });

        Route::group(['middleware' => 'auth'], function () {
            Route::get('/', [DashbordController::class, 'index'])->name('front.index');
            Route::post('/update-branch', [DashbordController::class, 'updateBranch'])->name('front.joinBranch.update');
            Route::post('/survey', [DashbordController::class, 'survey'])->name('front.survey');


            Route::get('users/logout', [AuthContoller::class, 'logout'])->name('front.logout');
            Route::get('user/profile', [ProfileController::class, 'index'])->name('front.profile.index');
            Route::get('user/profile', [ProfileController::class, 'index'])->name('front.profile.index');
            Route::get('/personal_data', [ProfileController::class, 'personalData'])->name('front.profile.personalData');
            Route::post('user/updatepersonalData', [ProfileController::class, 'updatePersonalData'])->name('front.profile.updatepersonalData');

            Route::post('user/profile/update', [ProfileController::class, 'UpdateProfile'])->name('front.profile.update');
            Route::get('user/change_passord', [ProfileController::class, 'changePassword'])->name('front.profile.changePassword');
            Route::post('user/change_password_profile', [ProfileController::class, 'changePasswordProfile'])->name('front.profile.changePasswordProfile');
            Route::group(['prefix' => 'attendances'], function () {
                Route::get('/', [AttendanceController::class, 'index'])->name('front.attendances.index');
                Route::get('getIndex', [AttendanceController::class, 'getIndex'])->name('front.attendances.getIndex');
                Route::post('getData', [AttendanceController::class, 'getData'])->name('front.attendances.getData');
            });


            Route::group(['prefix' => 'company-projects'], function () {

                Route::get('/', [CompanyProjectController::class, 'index'])->name('front.companyProjects.index');
                Route::get('/view/{id}', [CompanyProjectController::class, 'view'])->name('front.companyProjects.views');
                Route::post('addReviews', [CompanyProjectController::class, 'addReviews'])->name('front.companyProjects.addReviews');
                Route::post('/store_my_stone', [CompanyProjectController::class, 'storeMyStone'])->name('front.companyProjects.storeMyStone');
            });
            Route::group(['prefix' => 'restaurants'], function () {
                Route::get('/', [RestaurantController::class, 'index'])->name('front.restaurants.index');
                Route::get('/getIndex', [RestaurantController::class, 'getIndex'])->name('front.restaurants.getIndex');
            });
            Route::group(['prefix' => 'products'], function () {
                Route::get('/', [ProductsProductController::class, 'index'])->name('front.products.index');
            });

            Route::group(['prefix' => 'wallets'], function () {
                Route::get('/', [WalletController::class, 'index'])->name('front.wallets.index');
                Route::get('/getIndex', [WalletController::class, 'getIndex'])->name('front.wallets.getIndex');
                Route::post('/addBalance', [WalletController::class, 'addBalance'])->name('front.wallets.addBalance');
            });

            Route::group(['prefix' => 'orders'], function () {
                Route::get('/', [OrdersOrderController::class, 'index'])->name('front.orders.index');
                Route::get('/getIndex', [OrdersOrderController::class, 'getIndex'])->name('front.orders.getIndex');
                Route::post('/store', [OrdersOrderController::class, 'store'])->name('front.orders.store');
                Route::post('/show', [OrdersOrderController::class, 'show'])->name('front.orders.show');
                Route::get('/exportExcel', [OrdersOrderController::class, 'exportExcel'])->name('front.orders.exportExcel');
            });



            Route::group(['prefix' => 'services'], function () {

                Route::get('/', [ServiceController::class, 'index'])->name('front.services.index');
                Route::get('/getIndex', [ServiceController::class, 'getIndex'])->name('front.services.getIndex');
                Route::post('store', [ServiceController::class, 'store'])->name('front.services.store');
                Route::post('update', [ServiceController::class, 'update'])->name('front.services.update');
                Route::post('delete', [ServiceController::class, 'delete'])->name('front.services.delete');
                Route::get('/getOptions', [ServiceController::class, 'getOptions'])->name('front.services.getOptions');
                Route::post('/getAmount', [ServiceController::class, 'getAmount'])->name('front.services.getAmount');
            });




            Route::group(['prefix' => 'invoices'], function () {

                Route::get('/', [\App\Http\Controllers\Front\Invoices\InvoicesController::class, 'index'])->name('front.invoices.index');
                Route::get('/getIndex', [\App\Http\Controllers\Front\Invoices\InvoicesController::class, 'getIndex'])->name('front.invoices.getIndex');
                Route::post('/getInvoicesData', [\App\Http\Controllers\Front\Invoices\InvoicesController::class, 'getInvoicesData'])->name('front.invoices.getInvoicesData');
                Route::post('/update', [\App\Http\Controllers\Front\Invoices\InvoicesController::class, 'update'])->name('front.invoices.update');

                Route::post('/exemption', [\App\Http\Controllers\Front\Invoices\InvoicesController::class, 'exemption'])->name('front.invoices.exemption');
            });

            Route::group(['prefix' => 'appointments'], function () {

                Route::get('/', [\App\Http\Controllers\Front\Appointments\AppointmentController::class, 'index'])->name('front.appointments.index');

                Route::get('/event', [\App\Http\Controllers\Front\Appointments\AppointmentController::class, 'getData'])->name('front.appointments.getData');
                Route::post('/event', [\App\Http\Controllers\Front\Appointments\AppointmentController::class, 'store'])->name('front.appointments.store');
            });




            Route::group(['prefix' => 'jobs'], function () {

                Route::get('/', [JobController::class, 'index'])->name('front.jobs.index');
                Route::get('/view/{id}', [JobController::class, 'view'])->name('front.jobs.views');
                Route::post('/store', [JobController::class, 'store'])->name('front.jobs.store');
            });
            Route::group(['prefix' => 'training-courses'], function () {
                Route::get('/', [TraniningCoursesContoller::class, 'index'])->name('front.trainingCourses.index');
                Route::get('getIndex', [TraniningCoursesContoller::class, 'getIndex'])->name('front.trainingCourses.getIndex');
                Route::get('/create', [TraniningCoursesContoller::class, 'create'])->name('front.trainingCourses.create');
                Route::post('/store', [TraniningCoursesContoller::class, 'store'])->name('front.trainingCourses.store');

                Route::get('edit/{id}', [TraniningCoursesContoller::class, 'edit'])->name('front.trainingCourses.edit');
                Route::post('/update', [TraniningCoursesContoller::class, 'update'])->name('front.trainingCourses.update');
                Route::post('/delete', [TraniningCoursesContoller::class, 'delete'])->name('front.trainingCourses.delete');
            });


            Route::group(['prefix' => 'job-constrancts'], function () {
                Route::get('/', [JobConstranctController::class, 'index'])->name('front.jobConstrancts.index');
                Route::get('getIndex', [JobConstranctController::class, 'getIndex'])->name('front.jobConstrancts.getIndex');
                Route::get('/create', [JobConstranctController::class, 'create'])->name('front.jobConstrancts.create');
                Route::post('/store', [JobConstranctController::class, 'store'])->name('front.jobConstrancts.store');
                Route::get('edit/{id}', [JobConstranctController::class, 'edit'])->name('front.jobConstrancts.edit');
                Route::post('/update', [JobConstranctController::class, 'update'])->name('front.jobConstrancts.update');
                Route::post('/delete', [JobConstranctController::class, 'delete'])->name('front.jobConstrancts.delete');
            });
            Route::group(['prefix' => 'incomeMovements'], function () {
                Route::get('/', [IncomeMoveMentController::class, 'index'])->name('front.incomeMovements.index');
                Route::get('getIndex', [IncomeMoveMentController::class, 'getIndex'])->name('front.incomeMovements.getIndex');
                Route::get('/create', [IncomeMoveMentController::class, 'create'])->name('front.incomeMovements.create');
                Route::post('/store', [IncomeMoveMentController::class, 'store'])->name('front.incomeMovements.store');

                Route::get('edit/{id}', [IncomeMoveMentController::class, 'edit'])->name('front.incomeMovements.edit');
                Route::post('/update', [IncomeMoveMentController::class, 'update'])->name('front.incomeMovements.update');
                Route::post('/delete', [IncomeMoveMentController::class, 'delete'])->name('front.incomeMovements.delete');
            });



            Route::group(['prefix' => 'work-experiences'], function () {
                Route::get('/', [WorkExperiencesController::class, 'index'])->name('front.workExperiences.index');
                Route::get('getIndex', [WorkExperiencesController::class, 'getIndex'])->name('front.workExperiences.getIndex');
                Route::get('/create', [WorkExperiencesController::class, 'create'])->name('front.workExperiences.create');
                Route::post('/store', [WorkExperiencesController::class, 'store'])->name('front.workExperiences.store');

                Route::get('edit/{id}', [WorkExperiencesController::class, 'edit'])->name('front.workExperiences.edit');
                Route::post('/update', [WorkExperiencesController::class, 'update'])->name('front.workExperiences.update');
                Route::post('/delete', [WorkExperiencesController::class, 'delete'])->name('front.workExperiences.delete');
            });

            Route::group(['prefix' => 'scientific-cerificates'], function () {
                Route::get('/', [ScientificCerificateController::class, 'index'])->name('front.scientificCerificates.index');
                Route::get('getIndex', [ScientificCerificateController::class, 'getIndex'])->name('front.scientificCerificates.getIndex');
                Route::get('/create', [ScientificCerificateController::class, 'create'])->name('front.scientificCerificates.create');
                Route::post('/store', [ScientificCerificateController::class, 'store'])->name('front.scientificCerificates.store');

                Route::get('edit/{id}', [ScientificCerificateController::class, 'edit'])->name('front.scientificCerificates.edit');
                Route::post('/update', [ScientificCerificateController::class, 'update'])->name('front.scientificCerificates.update');
                Route::post('/delete', [ScientificCerificateController::class, 'delete'])->name('front.scientificCerificates.delete');
            });

            Route::group(['prefix' => 'projects'], function () {
                Route::get('/', [ProjectController::class, 'index'])->name('front.projects.index');
                Route::get('getIndex', [ProjectController::class, 'getIndex'])->name('front.projects.getIndex');
                Route::get('/create', [ProjectController::class, 'create'])->name('front.projects.create');
                Route::post('/store', [ProjectController::class, 'store'])->name('front.projects.store');

                Route::get('edit/{id}', [ProjectController::class, 'edit'])->name('front.projects.edit');
                Route::post('/update', [ProjectController::class, 'update'])->name('front.projects.update');
                Route::post('/delete', [ProjectController::class, 'delete'])->name('front.projects.delete');

                Route::post('/images', [ProjectController::class, 'saveProjectImages'])->name('front.projects.images.store');

                Route::post('/deleteProjectImages', [ProjectController::class, 'deleteProjectImages'])->name('front.projects.deleteProjectImages');
            });


            Route::group(['prefix' => 'offers'], function () {


                Route::post('/store', [OffersController::class, 'store'])->name('front.offers.store');
            });


            Route::group(['prefix' => 'chats'], function () {


                Route::get('/view/{key?}', [ChatController::class, 'view'])->name('front.chats.view');
                Route::post('/store', [ChatController::class, 'store'])->name('front.chats.store');
                Route::post('/getData', [ChatController::class, 'getData'])->name('front.chats.getData');
                Route::post('/saveMessage', [ChatController::class, 'saveMessage'])->name('front.chats.saveMessage');
            });


            Route::group(['prefix' => 'taqat-projects'], function () {

                Route::get('/{slug?}', [MyProjectController::class, 'index'])->name('front.myProjects.index');
            });

            Route::group(['prefix' => 'contrancts'], function () {
                Route::get('/', [ContstractController::class, 'index'])->name('front.contrancts.index');
                Route::get('/getIndex', [ContstractController::class, 'getIndex'])->name('front.contrancts.getIndex');
            });


            Route::group(['prefix' => 'interviews'], function () {
                Route::get('/', [JobInterviewsController::class, 'index'])->name('front.interviews.index');
                Route::get('/getIndex', [JobInterviewsController::class, 'getIndex'])->name('front.interviews.getIndex');
            });


            Route::group(['prefix' => 'payments'], function () {
                Route::get('/', [MystoneController::class, 'index'])->name('front.mystone.index');
                Route::get('/getIndex', [MystoneController::class, 'getIndex'])->name('front.mystone.getIndex');
                Route::post('/store', [MystoneController::class, 'store'])->name('front.mystone.store');

                Route::post('/withdraws', [MystoneController::class, 'withdraws'])->name('front.mystone.withdraws');
            });
            Route::group(['prefix' => 'withdraws'], function () {

                Route::get('/', [WithdrawsController::class, 'index'])->name('front.withdraws.index');
                Route::get('/getIndex', [WithdrawsController::class, 'getIndex'])->name('front.withdraws.getIndex');
            });

            Route::group(['prefix' => 'clock'], function () {

                Route::post('/clock_in', [ClockController::class, 'in'])->name('front.clock.in');
                Route::post('/clock_out', [ClockController::class, 'out'])->name('front.clock.out');
            });
        });

        Route::get('/autologin', function (\Illuminate\Http\Request $request) {

            $userId = $request->query('id');
            $apiToken = $request->query('api_token');
            $redirectUrl = $request->query('redirect_url', 'http://taqat-gaza.com/profile'); // Default to profile if no redirect URL is provided

            // Verify the API token
            $user = \App\Models\User::where('id', $userId)->where('api_token', $apiToken)->first();

            if ($user) {
                // Log in the user
                \Illuminate\Support\Facades\Auth::login($user);

                // Perform the redirection after login
                return redirect()->away($redirectUrl);
            }

            return redirect()->route('login')->withErrors(['message' => 'Auto-login failed']);
        });


        Route::get('/autologout', function () {
            auth()->logout();
            return redirect()->away('https://taqat-gaza.com')->with(['message' => trans('main.logout_success'), 'alert-type' => 'success']);;
        });
    }
);
