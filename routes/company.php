<?php
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\Companies\Comments\CommentsController;
use App\Http\Controllers\Companies\JobInterviews\JobInterviewsController;
use App\Http\Controllers\Companies\Jobs\JobController;
use App\Http\Controllers\Companies\Profile\ProfileController;
use App\Http\Controllers\Companies\Projects\ProjectController;
use App\Http\Controllers\Companies\IndexController;
use App\Http\Controllers\Companies\Mystone\MystoneController;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::group(['middleware' => 'guest','prefix'=>'companies'], function () {

        Route::get('login', [\App\Http\Controllers\Companies\Auth\AuthController::class, 'getLogin'])->name('companies.login');
        Route::post('post_login', [\App\Http\Controllers\Companies\Auth\AuthController::class, 'postLogin'])->name('companies.login.postlogin');

        Route::get('register', [\App\Http\Controllers\Companies\Auth\AuthController::class, 'getRegister'])->name('companies.register');
        Route::post('post_register', [\App\Http\Controllers\Companies\Auth\AuthController::class, 'postRegister'])->name('companies.register.post');

    });

Route::group(['middleware' => 'auth:company', 'prefix' => 'companies'], function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('companies.profile.index');
    Route::post('profile/update', [ProfileController::class, 'UpdateProfile'])->name('companies.profile.update');
    Route::get('/change_passord', [ProfileController::class, 'changePassword'])->name('companies.profile.changePassword');
    Route::post('/change_password_profile', [ProfileController::class, 'changePasswordProfile'])->name('companies.profile.changePasswordProfile');

    Route::get('/logout', [\App\Http\Controllers\Companies\Auth\AuthController::class, 'logout'])->name('companies.logout');


    Route::get('companies/dashboard', [IndexController::class, 'index'])->name('companies.index');

    Route::group(['prefix' => 'users'], function () {


        Route::get('/', [\App\Http\Controllers\Companies\Users\UsersController::class, 'index'])->name('companies.users.index');
        Route::get('/getIndex', [\App\Http\Controllers\Companies\Users\UsersController::class, 'getIndex'])->name('companies.users.getIndex');
        Route::get('/create', [\App\Http\Controllers\Companies\Users\UsersController::class, 'create'])->name('companies.users.create');
        Route::post('/store', [\App\Http\Controllers\Companies\Users\UsersController::class, 'store'])->name('companies.users.store');
        Route::get('/view/{id}', [\App\Http\Controllers\Companies\Users\UsersController::class, 'show'])->name('companies.users.views');
        Route::post('/delete', [\App\Http\Controllers\Companies\Users\UsersController::class, 'delete'])->name('companies.users.delete');
        Route::get('/edit/{id}', [\App\Http\Controllers\Companies\Users\UsersController::class, 'edit'])->name('companies.users.edit');
        Route::post('/update', [\App\Http\Controllers\Companies\Users\UsersController::class, 'update'])->name('companies.users.update');

    });


    Route::group(['prefix' => 'projects'], function () {


        Route::get('myprojects/{slug?}', [ProjectController::class, 'index'])->name('companies.projects.index');
        Route::get('/getIndex', [ProjectController::class, 'getIndex'])->name('companies.projects.getIndex');
        Route::get('/create', [ProjectController::class, 'create'])->name('companies.projects.create');
        Route::post('/store', [ProjectController::class, 'store'])->name('companies.projects.store');
        Route::get('/view/{id}', [ProjectController::class, 'show'])->name('companies.projects.views');
        Route::post('/delete', [ProjectController::class, 'delete'])->name('companies.projects.delete');
        Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('companies.projects.edit');
        Route::post('/update', [ProjectController::class, 'update'])->name('companies.projects.update');
        Route::post('/saveImage', [ProjectController::class, 'saveProjectImages'])->name('companies.projects.saveProjectImages');
        Route::post('/deleteProjectImages', [ProjectController::class, 'deleteProjectImages'])->name('companies.projects.deleteProjectImages');
        Route::post('/accepOffers', [ProjectController::class, 'acceptOffers'])->name('companies.projects.accepOffers');
        Route::post('/submit-rating', [ProjectController::class, 'submitRating'])->name('companies.projects.submitRating');
        // Route::post('/store_my_stone', [ProjectController::class, 'storeMyStone'])->name('companies.projects.storeMyStone');
        // Route::get('/paymnet_my_stone', [ProjectController::class, 'paymentMystone'])->name('companies.projects.paymentMystone');
        // Route::get('/verify_payment', [ProjectController::class, 'verifyPayment'])->name('companies.projects.verifyPayment');


        Route::post('/interview', [ProjectController::class, 'interview'])->name('companies.projects.interview');


    });


    Route::group(['prefix' => 'payments'], function () {

        Route::get('/',[MystoneController::class,'index'])->name('companies.mystone.index');

        Route::get('getIndex',[MystoneController::class,'getIndex'])->name('companies.mystone.getIndex');

        Route::post('store',[MystoneController::class,'store'])->name('companies.mystone.store');
        Route::get('payment',[MystoneController::class,'paymentMystone'])->name('companies.mystone.paymentMystone');
        Route::post('verify_payment',[MystoneController::class,'verifyPayment'])->name('companies.mystone.verifyPayment');

    });

    Route::group(['prefix' => 'jobs'], function () {
        Route::get('/myjob/{slug?}', [JobController::class, 'index'])->name('companies.jobs.index');
        Route::get('/getIndex', [JobController::class, 'getIndex'])->name('companies.jobs.getIndex');
        Route::get('/create', [JobController::class, 'create'])->name('companies.jobs.create');
        Route::post('/store', [JobController::class, 'store'])->name('companies.jobs.store');
        Route::get('/view/{id}', [JobController::class, 'show'])->name('companies.jobs.views');
        Route::post('/delete', [JobController::class, 'delete'])->name('companies.jobs.delete');
        Route::get('/edit/{id}', [JobController::class, 'edit'])->name('companies.jobs.edit');
        Route::post('/update', [JobController::class, 'update'])->name('companies.jobs.update');
        Route::post('/appetUsers', [JobController::class, 'appetUsers'])->name('companies.jobs.appetUsers');
        Route::post('/interview', [JobController::class, 'interview'])->name('companies.jobs.interview');



    });

    // companies.jobs.appetUsers


    Route::group(['prefix' => 'chats'], function () {


        Route::get('/view/{key?}', [CommentsController::class, 'view'])->name('companies.chats.view');
        Route::post('/store', [CommentsController::class, 'store'])->name('companies.chats.store');
  Route::post('/getData', [CommentsController::class, 'getData'])->name('companies.chats.getData');
  Route::post('/saveMessage', [CommentsController::class, 'saveMessage'])->name('companies.chats.saveMessage');


    });




    Route::group(['prefix' => 'attendances'], function () {
        Route::get('/', [\App\Http\Controllers\Companies\AttendanceController::class, 'index'])->name('companies.attendances.index');
        Route::get('/getIndex', [\App\Http\Controllers\Companies\AttendanceController::class, 'getIndex'])->name('companies.attendances.getIndex');
        Route::post('/getData', [\App\Http\Controllers\Companies\AttendanceController::class, 'getData'])->name('companies.attendances.getData');
        Route::post('/attendances', [\App\Http\Controllers\Companies\AttendanceController::class, 'attendances'])->name('companies.attendances.attendances');

        Route::post('/update', [\App\Http\Controllers\Companies\AttendanceController::class, 'update'])->name('companies.attendances.update');

    });
    Route::group(['prefix' => 'contrancts'], function () {
        Route::get('/', [\App\Http\Controllers\Companies\Contracts\ContranctsController::class, 'index'])->name('companies.contrancts.index');
        Route::get('/getIndex', [\App\Http\Controllers\Companies\Contracts\ContranctsController::class, 'getIndex'])->name('companies.contrancts.getIndex');


    });

    Route::group(['prefix' => 'interveiws'], function () {
        Route::get('/', [JobInterviewsController::class, 'index'])->name('companies.interveiws.index');
        Route::get('/getIndex', [JobInterviewsController::class, 'getIndex'])->name('companies.interveiws.getIndex');


    });
});

    });
?>
