<?php

use App\Http\Controllers\Admin\Accounts\Assets\AssetsController;
use App\Http\Controllers\Admin\Accounts\Equites\EquityController;
use App\Http\Controllers\Admin\Accounts\Expenses\ExpensesController;
use App\Http\Controllers\Admin\Accounts\Liabilities\LiabilitiesController;
use App\Http\Controllers\Admin\Accounts\TransactionContoller;
use App\Http\Controllers\Admin\Accounts\TreeController;
use App\Http\Controllers\Admin\Accounts\Users\AccountUserController;
use App\Http\Controllers\Admin\Activity\ActivityController;
use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\Agreements\AgreementController;
use App\Http\Controllers\Admin\BillExchange\BillExchangeController;
use App\Http\Controllers\Admin\Branch\BranchController;
use App\Http\Controllers\Admin\Chats\ChatController;
use App\Http\Controllers\Admin\Constracts\ContstractController;
use App\Http\Controllers\Admin\Expenses\Expensecontoller;
use App\Http\Controllers\Admin\Generators\ExpenseGeneratorContoller;
use App\Http\Controllers\Admin\Generators\GeneratorController;
use App\Http\Controllers\Admin\GeneratorSubscritions\GeneratorReceiptController;
use App\Http\Controllers\Admin\GeneratorSubscritions\GeneratorSubscriptionController;
use App\Http\Controllers\Admin\GeneratorSubscritions\ReadingGeneratorController;
use App\Http\Controllers\Admin\IncomeMovement\IncomeMoveMentController;
use App\Http\Controllers\Admin\InternetSubscriptionController;
use App\Http\Controllers\Admin\JobConstracts\JobConstranctController;
use App\Http\Controllers\Admin\JobInterviews\JobInterviewsController;
use App\Http\Controllers\Admin\Jobs\JobController;
use App\Http\Controllers\Admin\MettingRooms\MettingRoomController;
use App\Http\Controllers\Admin\Orders\OrderController;
use App\Http\Controllers\Admin\Projects\ProjectController;
use App\Http\Controllers\Admin\Reports\CompletionReportController;
use App\Http\Controllers\Admin\Reports\ReportsController;
use App\Http\Controllers\Admin\Restaurants\Categories\CategoriesController;
use App\Http\Controllers\Admin\Restaurants\Products\ProductController;
use App\Http\Controllers\Admin\Restaurants\RestaurantController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\Services\ServiceController;
use App\Http\Controllers\Admin\Subscriptions\SubScriptionController;
use App\Http\Controllers\Admin\Users\UsersController;
use App\Http\Controllers\Admin\Users\AdminController;
use App\Http\Controllers\Admin\Wallet\WalletController;
use App\Http\Controllers\Admin\Withdraws\WithdrawsController;
use App\Http\Controllers\Admin\WorkSpaceMangments\DeskMangments\DeskMangmentsControlller;
use App\Http\Controllers\Admin\WorkSpaceMangments\RoomMangments\RoomMangmentsController;
use App\Http\Controllers\Admin\WorkSpaceMangments\WorkSpances\WorkSpaceController;
use App\Http\Controllers\Dashboard\Notification\SmsNotificationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/last_reset', function () {
    return $user = User::query()->whereNotNull('last_reset')->get();
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {


        Route::group(['middleware' => 'guest', 'prefix' => 'admin'], function () {

            Route::get('login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'getLogin'])->name('admin.login');
            Route::post('post_login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'postLogin'])->name('admin.login.post');
        });


        Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
            Route::get('home', [\App\Http\Controllers\Admin\AdminController::class, 'home'])->name('admin.home')->middleware('can:view_dashboard');

            Route::group(['prefix' => 'companies'], function () {

                Route::get('/', [\App\Http\Controllers\Admin\Companies\CompanyController::class, 'index'])->name('admin.companies.index')->middleware('can:view_company');
                Route::get('/getIndex', [\App\Http\Controllers\Admin\Companies\CompanyController::class, 'getIndex'])->name('admin.companies.getIndex')->middleware('can:view_company');
                Route::get('/create', [\App\Http\Controllers\Admin\Companies\CompanyController::class, 'create'])->name('admin.companies.create')->middleware('can:create_company');
                Route::post('/store', [\App\Http\Controllers\Admin\Companies\CompanyController::class, 'store'])->name('admin.companies.store')->middleware('can:create_company');
                Route::get('/edit/{id}', [\App\Http\Controllers\Admin\Companies\CompanyController::class, 'edit'])->name('admin.companies.edit')->middleware('can:edit_company');
                Route::post('/update', [\App\Http\Controllers\Admin\Companies\CompanyController::class, 'update'])->name('admin.companies.update')->middleware('can:edit_company');
                Route::post('/delete', [\App\Http\Controllers\Admin\Companies\CompanyController::class, 'delete'])->name('admin.companies.delete')->middleware('can:delete_company');
            });

            Route::group(['prefix' => 'notifications'], function () {

                Route::get('/', [SmsNotificationController::class, 'create'])->name('admin.notifications.create');
                Route::post('/store', [SmsNotificationController::class, 'store'])->name('admin.notifications.store');
                Route::get('/getUsers', [SmsNotificationController::class, 'getUsers'])->name('admin.notifications.getUsers');
            });


            Route::group(['prefix' => 'income_movements'], function () {
                Route::get('/', [IncomeMoveMentController::class, 'index'])->name('admin.incomeMovements.index')->middleware('can:view_income_movements');
                Route::get('/getIndex', [IncomeMoveMentController::class, 'getIndex'])->name('admin.incomeMovements.getIndex')->middleware('can:view_income_movements');
                Route::get('/getData', [IncomeMoveMentController::class, 'getData'])->name('admin.incomeMovements.getData')->middleware('can:view_income_movements');

                Route::get('/edit/{id}', [IncomeMoveMentController::class, 'edit'])->name('admin.incomeMovements.edit')->middleware('can:edit_income_movements');
                Route::post('/update', [IncomeMoveMentController::class, 'update'])->name('admin.incomeMovements.update')->middleware('can:edit_income_movements');
                Route::post('/delete', [IncomeMoveMentController::class, 'delete'])->name('admin.incomeMovements.delete')->middleware('can:delete_income_movements');
            });



            Route::group(['prefix' => 'job_constrancts'], function () {
                Route::get('/', [JobConstranctController::class, 'index'])->name('admin.jobConstrancts.index')->middleware('can:view_job_constrancts');
                Route::get('/getIndex', [JobConstranctController::class, 'getIndex'])->name('admin.jobConstrancts.getIndex')->middleware('can:view_job_constrancts');
                Route::get('/getData', [JobConstranctController::class, 'getData'])->name('admin.jobConstrancts.getData')->middleware('can:view_job_constrancts');
                Route::post('/store', [JobConstranctController::class, 'store'])->name('admin.jobConstrancts.store')->middleware('can:edit_job_constrancts');

                Route::get('/edit/{id}', [JobConstranctController::class, 'edit'])->name('admin.jobConstrancts.edit')->middleware('can:edit_job_constrancts');
                Route::post('/update', [JobConstranctController::class, 'update'])->name('admin.jobConstrancts.update')->middleware('can:edit_job_constrancts');

                Route::post('/delete', [JobConstranctController::class, 'delete'])->name('admin.jobConstrancts.delete')->middleware('can:delete_income_movements');
            });

            Route::group(['prefix' => 'jobs', 'middleware' => 'can:view_jobs'], function () {
                Route::get('/{slug?}', [JobController::class, 'index'])->name('admin.jobs.index');
                Route::get('jobs/getIndex', [JobController::class, 'getIndex'])->name('admin.jobs.getIndex');
                Route::get('/view/{id}', [JobController::class, 'show'])->name('admin.jobs.views');

                Route::get('/edit/{id}', [JobController::class, 'edit'])->name('admin.jobs.edit');
                Route::post('job/update', [JobController::class, 'update'])->name('admin.jobs.update');

                Route::post('job/delete', [JobController::class, 'delete'])->name('admin.jobs.delete');
            });


            Route::group(['prefix' => 'bill-exchanges'], function () {
                Route::get('/', [BillExchangeController::class, 'index'])->name('admin.billExchages.index');
                Route::get('getIndex', [BillExchangeController::class, 'getIndex'])->name('admin.billExchages.getIndex');
                Route::post('/store', [BillExchangeController::class, 'store'])->name('admin.billExchages.store');

                Route::post('/update', [BillExchangeController::class, 'update'])->name('admin.billExchages.update');
                Route::post('/delete', [BillExchangeController::class, 'delete'])->name('admin.billExchages.delete');
                Route::get('/pdf/{id}', [BillExchangeController::class, 'print'])->name('admin.billExchages.pdf');
            });
            Route::group(['prefix' => 'projects', 'middleware' => 'can:view_projects'], function () {
                Route::get('/{slug?}', [ProjectController::class, 'index'])->name('admin.projects.index');
                Route::get('/getIndex', [ProjectController::class, 'getIndex'])->name('admin.projects.getIndex');
                Route::get('/view/{id}', [ProjectController::class, 'show'])->name('admin.projects.view');

                Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('admin.projects.edit');
                Route::post('/update', [ProjectController::class, 'update'])->name('admin.projects.update');
                Route::post('/delete', [ProjectController::class, 'delete'])->name('admin.projects.delete');
            });


            Route::group(['prefix' => 'reports'], function () {
                Route::get('/', [ReportsController::class, 'index'])->name('admin.reports.index')->middleware('can:report_attendances');
                Route::post('/getData', [ReportsController::class, 'searchReports'])->name('admin.reports.getData')->middleware('can:report_attendances');
                Route::get('/get_user_report', [ReportsController::class, 'getAattendances'])->name('admin.reports.getAattendances')->middleware('can:report_user_attendances');
                Route::get('/completion_report', [CompletionReportController::class, 'index'])->name('admin.reports.completionReport');
                Route::get('/get_completion_report', [CompletionReportController::class, 'getIndex'])->name('admin.reports.getCompletionReport');
                Route::post('/get_completion_data', [CompletionReportController::class, 'getData'])->name('admin.reports.getCompletionData');
            });

            Route::group(['prefix' => 'chats', 'middleware' => 'can:view_chats'], function () {

                Route::get('/{key?}', [ChatController::class, 'view'])->name('admin.chats.view');

                Route::post('/getData', [ChatController::class, 'getData'])->name('admin.chats.getData');
            });

            Route::group(['prefix' => 'general'], function () {

                Route::get('/getWorkExperiences', [\App\Http\Controllers\Admin\Generals\GeneralController::class, 'getWorkExperiences'])->name('admin.workExperiences.getIndex');
                Route::get('/getProjects', [\App\Http\Controllers\Admin\Generals\GeneralController::class, 'getProjects'])->name('admin.projects.general');
                Route::get('/getScientificCertificates', [\App\Http\Controllers\Admin\Generals\GeneralController::class, 'getScientificCertificates'])->name('admin.scientificCerificates.getIndex');
                Route::get('/getTrainingCourses', [\App\Http\Controllers\Admin\Generals\GeneralController::class, 'getTrainingCourses'])->name('admin.trainingCourses.getIndex');
            });


            Route::group(['prefix' => 'attendances', 'middleware' => 'can:view_attendances'], function () {
                Route::get('/', [\App\Http\Controllers\Admin\AttendanceController::class, 'index'])->name('admin.attendances.index');
                Route::get('/getIndex', [\App\Http\Controllers\Admin\AttendanceController::class, 'getIndex'])->name('admin.attendances.getIndex');
                Route::post('/getData', [\App\Http\Controllers\Admin\AttendanceController::class, 'getData'])->name('admin.attendances.getData');
                Route::post('/attendances', [\App\Http\Controllers\Admin\AttendanceController::class, 'attendances'])->name('admin.attendances.attendances');
                Route::post('/update', [\App\Http\Controllers\Admin\AttendanceController::class, 'update'])->name('admin.attendances.update')->middleware('can:update_attendances');
            });


            Route::group(['prefix' => 'logs', 'middleware' => 'can:view_logs'], function () {
                Route::get('/', [\App\Http\Controllers\Admin\Logs\LogController::class, 'index'])->name('admin.logs.index');
                Route::get('/getIndex', [\App\Http\Controllers\Admin\Logs\LogController::class, 'getIndex'])->name('admin.logs.getIndex');
                Route::post('/getData', [\App\Http\Controllers\Admin\Logs\LogController::class, 'getData'])->name('admin.logs.getData');
                Route::post('/delete', [\App\Http\Controllers\Admin\Logs\LogController::class, 'delete'])->name('admin.logs.delete');
            });
            Route::group(['prefix' => 'profile'], function () {
                Route::get('/', [\App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('admin.profile.index');
                Route::post('/update', [\App\Http\Controllers\Admin\ProfileController::class, 'UpdateProfile'])->name('admin.profile.update');
                Route::get('/change_password', [\App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('admin.profile.changePassword');
                Route::post('/update_change_password', [\App\Http\Controllers\Admin\ProfileController::class, 'changePasswordProfile'])->name('admin.profile.changePasswordProfile');
            });
            Route::get('logout', [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('admin.logout');











            Route::group(['prefix' => 'contrancts', 'middleware' => 'can:view_constrancts'], function () {
                Route::get('/', [ContstractController::class, 'index'])->name('admin.contrancts.index');
                Route::get('/getIndex', [ContstractController::class, 'getIndex'])->name('admin.contrancts.getIndex');
            });


            Route::group(['prefix' => 'interviews', 'middleware' => 'can:view_interviews'], function () {
                Route::get('/', [JobInterviewsController::class, 'index'])->name('admin.interviews.index');
                Route::get('/getIndex', [JobInterviewsController::class, 'getIndex'])->name('admin.interviews.getIndex');
            });

            Route::group(['prefix' => 'roles'], function () {
                Route::get('/', [RoleController::class, 'index'])->name('admin.roles.index');
                Route::get('/getIndex', [RoleController::class, 'getIndex'])->name('admin.roles.getIndex');
                Route::get('/create', [RoleController::class, 'create'])->name('admin.roles.create');
                Route::post('/store', [RoleController::class, 'store'])->name('admin.roles.store');
                Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit');

                Route::post('/update', [RoleController::class, 'update'])->name('admin.roles.update');
                Route::post('/updateStatus', [RoleController::class, 'updateStatus'])->name('admin.roles.updateStatus');
            });

            Route::group(['prefix' => 'agreements'], function () {
                Route::get('/', [AgreementController::class, 'index'])->name('admin.agreements.index');
                Route::get('/getIndex', [AgreementController::class, 'getIndex'])->name('admin.agreements.getIndex');
                Route::post('/store', [AgreementController::class, 'store'])->name('admin.agreements.store');

                Route::post('/update', [AgreementController::class, 'update'])->name('admin.agreements.update');
                Route::post('/delete', [AgreementController::class, 'delete'])->name('admin.agreements.delete');
            });
            Route::group(['prefix' => 'branches'], function () {
                Route::get('/', [BranchController::class, 'index'])->name('admin.branchs.index')->middleware('can:view_branch');
                Route::get('/getIndex', [BranchController::class, 'getIndex'])->name('admin.branchs.getIndex')->middleware('can:view_branch');
                Route::post('/store', [BranchController::class, 'store'])->name('admin.branchs.store')->middleware('can:create_branch');

                Route::post('/update', [BranchController::class, 'update'])->name('admin.branchs.update')->middleware('can:edit_branch');
                Route::post('/updateStatus', [BranchController::class, 'updateStatus'])->name('admin.branchs.updateStatus');
                Route::post('/delete', [BranchController::class, 'delete'])->name('admin.branchs.delete')->middleware('can:delete_branch');
            });

            Route::group(['prefix' => 'admins'], function () {
                Route::get('/', [AdminAdminController::class, 'index'])->name('admin.admins.index')->middleware('can:view_admin');
                Route::get('/getIndex', [AdminAdminController::class, 'getIndex'])->name('admin.admins.getIndex')->middleware('can:view_admin');
                Route::get('/create', [AdminAdminController::class, 'create'])->name('admin.admins.create')->middleware('can:add_admin');

                Route::post('/store', [AdminAdminController::class, 'store'])->name('admin.admins.store')->middleware('can:add_admin');
                Route::get('/edit/{id}', [AdminAdminController::class, 'edit'])->name('admin.admins.edit')->middleware('can:edit_admin');

                Route::post('/update', [AdminAdminController::class, 'update'])->name('admin.admins.update')->middleware('can:edit_admin');
                Route::post('/updateStatus', [AdminAdminController::class, 'updateStatus'])->name('admin.admins.updateStatus')->middleware('can:edit_admin');
                Route::post('/delete', [AdminAdminController::class, 'delete'])->name('admin.admins.delete')->middleware('can:delete_admin');
            });




            Route::group(['prefix' => 'users'], function () {

                Route::get('/{slug?}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'index'])->name('admin.users.index')->middleware('can:view_users');
                Route::get('users/getIndex', [\App\Http\Controllers\Admin\Users\UsersController::class, 'getIndex'])->name('admin.users.getIndex')->middleware('can:view_users');
                Route::get('users/getAttendance', [\App\Http\Controllers\Admin\Users\UsersController::class, 'getAttendance'])->name('admin.users.getAttendance')->middleware('can:view_users');
                Route::get('new-users/create', [\App\Http\Controllers\Admin\Users\UsersController::class, 'create'])->name('admin.users.create')->middleware('can:add_users');
                Route::post('new-users/store', [\App\Http\Controllers\Admin\Users\UsersController::class, 'store'])->name('admin.users.store')->middleware('can:add_users');
                Route::get('/view/{id?}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'show'])->name('admin.users.views')->middleware('can:view_users');
                Route::post('users/delete', [\App\Http\Controllers\Admin\Users\UsersController::class, 'delete'])->name('admin.users.delete')->middleware('can:delete_users');
                Route::get('/edit/{id}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'edit'])->name('admin.users.edit')->middleware('can:edit_users');
                Route::post('/update', [\App\Http\Controllers\Admin\Users\UsersController::class, 'update'])->name('admin.users.update')->middleware('can:edit_users');
                Route::post('/addRequestJoin', [\App\Http\Controllers\Admin\Users\UsersController::class, 'addRequestJoin'])->name('admin.users.addRequestJoin')->middleware('can:view_users');
                Route::get('users/exports/{slug?}', [\App\Http\Controllers\Admin\Users\UsersController::class, 'export'])->name('admin.users.exports')->middleware('can:view_users');
                Route::post('notification/sendNotification', [\App\Http\Controllers\Admin\Users\UsersController::class, 'sendNotification'])->name('admin.users.sendNotification')->middleware('can:view_users');
                Route::post('users/addToBranch', [\App\Http\Controllers\Admin\Users\UsersController::class, 'addToBranch'])->name('admin.users.addToBranch');

                Route::post('users/showDetails', [\App\Http\Controllers\Admin\Users\UsersController::class, 'showDetails'])->name('admin.users.showDetails');
                Route::post('users/postVerification', [\App\Http\Controllers\Admin\Users\UsersController::class, 'postVerification'])->name('admin.users.postVerification');



                Route::post('invoice/create_invoice', [\App\Http\Controllers\Admin\Users\UsersController::class, 'checkAndCreateInvoice'])->name('admin.users.createInvoice');
                Route::post('invoice/create_single_invoice', [\App\Http\Controllers\Admin\Users\UsersController::class, 'storeSingleInvoce'])->name('admin.users.storeSingleInvoce');
                Route::get('users/getByBranch', [\App\Http\Controllers\Admin\Users\UsersController::class, 'getByBranch'])->name('admin.users.getByBranch')->middleware('can:edit_users');
                Route::get('users/getByDeskMangments', [\App\Http\Controllers\Admin\Users\UsersController::class, 'getByDeskMangments'])->name('admin.users.getByDeskMangments')->middleware('can:edit_users');
                Route::get('users/getByRooms', [\App\Http\Controllers\Admin\Users\UsersController::class, 'getByRooms'])->name('admin.users.getByRooms')->middleware('can:edit_users');
                Route::post('users/add_tow_work_space', [\App\Http\Controllers\Admin\Users\UsersController::class, 'addToWorkSpace'])->name('admin.users.addToWorkSpace');
                Route::get('users/getLog', [\App\Http\Controllers\Admin\Users\UsersController::class, 'getLog'])->name('admin.users.getLog');
                Route::get('users/getTotalHours', [\App\Http\Controllers\Admin\Users\UsersController::class, 'getTotalHours'])->name('admin.users.getTotalHours');
                Route::get('users/exportLog', [\App\Http\Controllers\Admin\Users\UsersController::class, 'exportLog'])->name('admin.users.exportLog');

                Route::get('users/services', [UsersController::class, 'serviceList'])->name('admin.users.getServices');
                Route::post('users/delete_service', [\App\Http\Controllers\Admin\Users\UsersController::class, 'deleteService'])->name('admin.users.deleteService');
                Route::post('users/add_service', [\App\Http\Controllers\Admin\Users\UsersController::class, 'addService'])->name('admin.users.addService');

                Route::post('users/get_amount', [UsersController::class, 'getAmount'])->name('admin.users.getAmount');
                Route::post('users/addSubscription', [UsersController::class, 'addSubscription'])->name('admin.users.addSubscription');
                Route::post('users/restore_users', [UsersController::class, 'restoreUsers'])->name('admin.users.restoreUsers');
                Route::get('users/userTYpeAccount', [UsersController::class, 'userTYpeAccount'])->name('admin.users.userTYpeAccount');
                Route::get('users/updateAccountUser', [UsersController::class, 'updateAccountUser'])->name('admin.users.updateAccountUser');
                Route::get('users/getChildExpenses', [UsersController::class, 'getChildExpenses'])->name('admin.users.getChildExpenses');
                Route::post('users/addExpense', [UsersController::class, 'addExpense'])->name('admin.users.addExpense');


                Route::get('users/getUserExpenses', [UsersController::class, 'getUserExpenses'])->name('admin.users.expenses');
                Route::get('users/getWallet', [UsersController::class, 'getWallet'])->name('admin.users.getWallet');

                Route::post('users/updateWallet', [UsersController::class, 'updateWallet'])->name('admin.users.wallet.update');

                Route::post('users/addBalance', [UsersController::class, 'addBalance'])->name('admin.users.wallet.addBalance');
                Route::get('users/veririfcation', [UsersController::class, 'veririfcation'])->name('admin.users.veririfcation');
                Route::get('users/getVerification', [UsersController::class, 'getVerification'])->name('admin.users.getVerification');
            });


            Route::group(['prefix' => 'invoices'], function () {

                Route::get('/', [\App\Http\Controllers\Admin\Invoices\InvoicesController::class, 'index'])->name('admin.invoices.index');
                Route::get('/getIndex', [\App\Http\Controllers\Admin\Invoices\InvoicesController::class, 'getIndex'])->name('admin.invoices.getIndex');
                Route::get('/generate-receipt', [\App\Http\Controllers\Admin\Invoices\InvoicesController::class, 'generatereceipt'])->name('admin.invoices.generateReceipt');


                Route::post('/getInvoicesData', [\App\Http\Controllers\Admin\Invoices\InvoicesController::class, 'getInvoicesData'])->name('admin.invoices.getInvoicesData');
                Route::post('/update', [\App\Http\Controllers\Admin\Invoices\InvoicesController::class, 'update'])->name('admin.invoices.update');
                Route::post('/delete', [\App\Http\Controllers\Admin\Invoices\InvoicesController::class, 'delete'])->name('admin.invoices.delete');
                Route::post('/send-sms', [\App\Http\Controllers\Admin\Invoices\InvoicesController::class, 'SendSms'])->name('admin.invoices.SendSms');
                Route::post('/send-sms-invoice', [\App\Http\Controllers\Admin\Invoices\InvoicesController::class, 'sendInvoiceSms'])->name('admin.invoices.sendInvoiceSms');
            });

            Route::group(['prefix' => 'wallets'], function () {

                Route::get('/', [WalletController::class, 'index'])->name('admin.wallets.index');
                Route::get('/getIndex', [WalletController::class, 'getIndex'])->name('admin.wallets.getIndex');
                Route::get('/wallet-Recipt', [WalletController::class, 'walletRecipt'])->name('admin.wallets.walletRecipt');
                Route::get('/getWalletRecipts', [WalletController::class, 'getWalletRecipt'])->name('admin.wallets.getWalletRecipts');


                Route::post('/update', [WalletController::class, 'update'])->name('admin.wallets.update');
                Route::post('/delete', [WalletController::class, 'delete'])->name('admin.wallets.delete');
            });
            Route::group(['prefix' => 'expenses'], function () {

                Route::get('/', [Expensecontoller::class, 'index'])->name('admin.expenses.index');
                Route::get('/getIndex', [Expensecontoller::class, 'getIndex'])->name('admin.expenses.getIndex');
                Route::get('/exportExcel', [Expensecontoller::class, 'exportExcel'])->name('admin.expenses.exportExcel');


                Route::post('/store', [Expensecontoller::class, 'store'])->name('admin.expenses.store');

                Route::post('/update', [Expensecontoller::class, 'update'])->name('admin.expenses.update');
                Route::post('/delete', [Expensecontoller::class, 'delete'])->name('admin.expenses.delete');
            });
            Route::group(['prefix' => 'restaurants'], function () {

                Route::get('/', [RestaurantController::class, 'index'])->name('admin.restaurants.index')->middleware('can:view_restaurant');
                Route::get('/getIndex', [RestaurantController::class, 'getIndex'])->name('admin.restaurants.getIndex')->middleware('can:view_restaurant');
                Route::get('/exportExcel', [RestaurantController::class, 'exportExcel'])->name('admin.restaurants.exportExcel')->middleware('can:view_restaurant');
                Route::get('/view/{id}', [RestaurantController::class, 'view'])->name('admin.restaurants.view')->middleware('can:view_restaurant');

                Route::post('/store', [RestaurantController::class, 'store'])->name('admin.restaurants.store')->middleware('can:add_restaurant');
                Route::post('/update', [RestaurantController::class, 'update'])->name('admin.restaurants.update')->middleware('can:edit_restaurant');
                Route::post('/delete', [RestaurantController::class, 'delete'])->name('admin.restaurants.delete')->middleware('can:delete_restaurant');
                Route::post('/payment', [RestaurantController::class, 'payment'])->name('admin.restaurants.payment');
                Route::get('/getPayment', [RestaurantController::class, 'getPayment'])->name('admin.restaurants.getPayment');

                Route::post('/updatePayment', [RestaurantController::class, 'updatePayment'])->name('admin.restaurants.updatePayment');

                Route::post('/deletePyament', [RestaurantController::class, 'deletePyament'])->name('admin.restaurants.deletePyament');

                // admin.restaurants.deletePyament
            });

            Route::group(['prefix' => 'categories'], function () {

                Route::get('/', [CategoriesController::class, 'index'])->name('admin.categories.index')->middleware('can:view_category');
                Route::get('/getIndex', [CategoriesController::class, 'getIndex'])->name('admin.categories.getIndex')->middleware('can:view_category');
                Route::post('/store', [CategoriesController::class, 'store'])->name('admin.categories.store')->middleware('can:add_category');
                Route::post('/update', [CategoriesController::class, 'update'])->name('admin.categories.update')->middleware('can:edit_category');
                Route::post('/delete', [CategoriesController::class, 'delete'])->name('admin.categories.delete')->middleware('can:delete_category');
                Route::post('/update_status', [CategoriesController::class, 'updateStatus'])->name('admin.categories.updateStatus')->middleware('can:update_status_category');
            });

            Route::group(['prefix' => 'products'], function () {

                Route::get('/', [ProductController::class, 'index'])->name('admin.products.index')->middleware('can:view_product');
                Route::get('/getIndex', [ProductController::class, 'getIndex'])->name('admin.products.getIndex')->middleware('can:view_product');
                Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store')->middleware('can:add_product');
                Route::post('/update', [ProductController::class, 'update'])->name('admin.products.update')->middleware('can:edit_product');
                Route::post('/delete', [ProductController::class, 'delete'])->name('admin.products.delete')->middleware('can:delete_product');
                Route::post('/update_status', [ProductController::class, 'updateStatus'])->name('admin.products.updateStatus')->middleware('can:update_status_product');
            });

            Route::group(['prefix' => 'orders'], function () {

                Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index')->middleware('can:view_order');
                Route::get('/getIndex', [OrderController::class, 'getIndex'])->name('admin.orders.getIndex')->middleware('can:view_order');

                Route::post('show/', [OrderController::class, 'show'])->name('admin.orders.show')->middleware('can:view_order');
                Route::post('delete/', [OrderController::class, 'delete'])->name('admin.orders.delete');
            });



            Route::group(['prefix' => 'join-bracnhes'], function () {

                Route::get('/', [\App\Http\Controllers\Admin\JoinBranches\JoinBranchController::class, 'index'])->name('admin.joinBranches.index')->middleware('can:view_user_branch');
                Route::get('/getIndex', [\App\Http\Controllers\Admin\JoinBranches\JoinBranchController::class, 'getIndex'])->name('admin.joinBranches.getIndex')->middleware('can:view_user_branch');
                Route::post('/update', [\App\Http\Controllers\Admin\JoinBranches\JoinBranchController::class, 'update'])->name('admin.joinBranches.update')->middleware('can:update_user_branch');
                Route::post('/delete', [\App\Http\Controllers\Admin\JoinBranches\JoinBranchController::class, 'delete'])->name('admin.joinBranches.delete')->middleware('can:delete_user_branch');
            });

            Route::group(['prefix' => 'internet-subscriptions'], function () {
                Route::get('/', [InternetSubscriptionController::class, 'index'])->name('admin.internetSubscriptions.index')->middleware('can:view_internet_subscription');

                Route::get('/getIndex', [InternetSubscriptionController::class, 'getIndex'])->name('admin.internetSubscriptions.getIndex')->middleware('can:view_internet_subscription');
                Route::get('/pending', [InternetSubscriptionController::class, 'pending'])->name('admin.internetSubscriptions.pendding')->middleware('can:view_pendding_internet_subscription');
                Route::get('/getPending', [InternetSubscriptionController::class, 'getPending'])->name('admin.internetSubscriptions.getPending')->middleware('can:view_pendding_internet_subscription');
                Route::get('/ready', [InternetSubscriptionController::class, 'ready'])->name('admin.internetSubscriptions.ready');
                Route::get('/getReady', [InternetSubscriptionController::class, 'getReady'])->name('admin.internetSubscriptions.getReady');
                Route::get('/available', [InternetSubscriptionController::class, 'available'])->name('admin.internetSubscriptions.available')->middleware('can:view_available_internet_subscription');
                Route::get('/getAvailable', [InternetSubscriptionController::class, 'getAvailable'])->name('admin.internetSubscriptions.getAvailable')->middleware('can:view_available_internet_subscription');

                Route::get('/expired', [InternetSubscriptionController::class, 'expired'])->name('admin.internetSubscriptions.expired')->middleware('can:view_expired_internet_subscription');
                Route::get('/getExpired', [InternetSubscriptionController::class, 'getExpired'])->name('admin.internetSubscriptions.getExpired')->middleware('can:view_expired_internet_subscription');
                Route::post('/update', [InternetSubscriptionController::class, 'update'])->name('admin.internetSubscriptions.update')->middleware('can:edit_internet_subscription');
                Route::post('/store', [InternetSubscriptionController::class, 'store'])->name('admin.internetSubscriptions.store')->middleware('can:add_internet_subscription');
                Route::get('/checkUsers', [InternetSubscriptionController::class, 'checkUsers'])->name('admin.internetSubscriptions.checkUsers')->middleware('can:view_internet_subscription');
                Route::post('/assign', [InternetSubscriptionController::class, 'assignSubscription'])->name('admin.internetSubscriptions.assign')->middleware('can:assign_internet_subscription');
            });
            Route::group(['prefix' => 'subscription-types'], function () {
                Route::get('/', [SubScriptionController::class, 'index'])->name('admin.subscriptionTypes.index');
                Route::get('/getIndex', [SubScriptionController::class, 'getIndex'])->name('admin.subscriptionTypes.getIndex');
                Route::post('/store', [SubScriptionController::class, 'store'])->name('admin.subscriptionTypes.store');
                Route::post('/update', [SubScriptionController::class, 'update'])->name('admin.subscriptionTypes.update');
                Route::post('/delete', [SubScriptionController::class, 'delete'])->name('admin.subscriptionTypes.delete');
            });

            Route::group(['prefix' => 'generator-subscriptions'], function () {
                Route::get('/', [GeneratorSubscriptionController::class, 'index'])->name('admin.generatorSubscriptions.index');
                Route::get('/getIndex', [GeneratorSubscriptionController::class, 'getIndex'])->name('admin.generatorSubscriptions.getIndex');
                Route::post('/store', [GeneratorSubscriptionController::class, 'store'])->name('admin.generatorSubscriptions.store');
                Route::post('/update', [GeneratorSubscriptionController::class, 'update'])->name('admin.generatorSubscriptions.update');
                Route::post('/delete', [GeneratorSubscriptionController::class, 'delete'])->name('admin.generatorSubscriptions.delete');
                Route::post('/generatorReceipt', [GeneratorSubscriptionController::class, 'generatorReceipt'])->name('admin.generatorSubscriptions.generatorReceipt');
                Route::get('/getReceiptsGenerator', [GeneratorSubscriptionController::class, 'getReceiptsGenerator'])->name('admin.generatorSubscriptions.getReceiptsGenerator');
                Route::post('/calculateConsumptionValue', [GeneratorSubscriptionController::class, 'calculateConsumptionValue'])->name('admin.generatorSubscriptions.calculateConsumptionValue');
                Route::get('/search', [GeneratorSubscriptionController::class, 'search'])->name('admin.generatorSubscriptions.search');
                Route::post('/getKwatPrice', [GeneratorSubscriptionController::class, 'getKwatPrice'])->name('admin.generatorSubscriptions.getKwatPrice');
            });


            Route::group(['prefix' => 'generators'], function () {
                Route::get('/', [GeneratorController::class, 'index'])->name('admin.generators.index');
                Route::get('/getIndex', [GeneratorController::class, 'getIndex'])->name('admin.generators.getIndex');
                Route::post('/store', [GeneratorController::class, 'store'])->name('admin.generators.store');
                Route::post('/update', [GeneratorController::class, 'update'])->name('admin.generators.update');
                Route::post('/delete', [GeneratorController::class, 'delete'])->name('admin.generators.delete');
                Route::get('/exportExcel', [GeneratorController::class, 'exportExcel'])->name('admin.generators.exportExcel');
                Route::post('/importExcel', [GeneratorController::class, 'importExcel'])->name('admin.generators.importExcel');
                Route::post('/restore', [GeneratorController::class, 'restore'])->name('admin.generators.restore');
                Route::get('/generator-expenses', [GeneratorController::class, 'getgeneratorExpenses'])->name('admin.generators.getgeneratorExpenses');
                Route::post('/store-generator-expenses', [GeneratorController::class, 'storeGeneratorExpenses'])->name('admin.generators.storeGeneratorExpenses');
                Route::post('/update-generator-expenses', [GeneratorController::class, 'updateGeneratorExpenses'])->name('admin.generators.updateGeneratorExpenses');
            });
            Route::group(['prefix' => 'generator-subscriptions'], function () {
                Route::get('/', [GeneratorSubscriptionController::class, 'index'])->name('admin.generatorSubscriptions.index');
                Route::get('/getIndex', [GeneratorSubscriptionController::class, 'getIndex'])->name('admin.generatorSubscriptions.getIndex');
                Route::post('/store', [GeneratorSubscriptionController::class, 'store'])->name('admin.generatorSubscriptions.store');
                Route::post('/update', [GeneratorSubscriptionController::class, 'update'])->name('admin.generatorSubscriptions.update');
                Route::post('/delete', [GeneratorSubscriptionController::class, 'delete'])->name('admin.generatorSubscriptions.delete');
                Route::post('/generatorReceipt', [GeneratorSubscriptionController::class, 'generatorReceipt'])->name('admin.generatorSubscriptions.generatorReceipt');
                Route::get('/getReceiptsGenerator', [GeneratorSubscriptionController::class, 'getReceiptsGenerator'])->name('admin.generatorSubscriptions.getReceiptsGenerator');
                Route::post('/calculateConsumptionValue', [GeneratorSubscriptionController::class, 'calculateConsumptionValue'])->name('admin.generatorSubscriptions.calculateConsumptionValue');
                Route::post('/sendSms', [GeneratorSubscriptionController::class, 'sendSms'])->name('admin.generatorSubscriptions.sendSms');
                Route::get('/getReceiptData', [GeneratorSubscriptionController::class, 'getReceiptData'])->name('admin.generatorSubscriptions.getReceiptData');
                Route::post('/updateReceipt', [GeneratorSubscriptionController::class, 'updateReceipt'])->name('admin.generatorSubscriptions.updateReceipt');
                Route::get('/getReadingData', [GeneratorSubscriptionController::class, 'getReading'])->name('admin.generatorSubscriptions.getReadingData');
                Route::post('/deletegeneratorExpenses', [GeneratorSubscriptionController::class, 'deletegeneratorExpenses'])->name('admin.generators.deletegeneratorExpenses');


                Route::post('/restore', [GeneratorSubscriptionController::class, 'restore'])->name('admin.generatorSubscriptions.restore');
            });
            Route::group(['prefix' => 'reading-generators'], function () {
                Route::get('/', [ReadingGeneratorController::class, 'index'])->name('admin.readingGenerators.index');
                Route::get('/getIndex', [ReadingGeneratorController::class, 'getIndex'])->name('admin.readingGenerators.getIndex');
                Route::post('/store', [ReadingGeneratorController::class, 'store'])->name('admin.readingGenerators.store');
                Route::post('/update', [ReadingGeneratorController::class, 'update'])->name('admin.readingGenerators.update');
                Route::post('/delete', [ReadingGeneratorController::class, 'delete'])->name('admin.readingGenerators.delete');
                Route::get('/search', [ReadingGeneratorController::class, 'search'])->name('admin.readingGenerators.search');
                Route::post('/restore', [ReadingGeneratorController::class, 'restore'])->name('admin.readingGenerators.restore');
            });

            Route::group(['prefix' => 'receipt-generators'], function () {
                Route::get('/', [GeneratorReceiptController::class, 'index'])->name('admin.generatorReceipts.index');
                Route::get('/getIndex', [GeneratorReceiptController::class, 'getIndex'])->name('admin.generatorReceipts.getIndex');
                Route::post('/store', [GeneratorReceiptController::class, 'store'])->name('admin.generatorReceipts.store');
                Route::post('/update', [GeneratorReceiptController::class, 'update'])->name('admin.generatorReceipts.update');
                Route::post('/delete', [GeneratorReceiptController::class, 'delete'])->name('admin.generatorReceipts.delete');
                Route::get('/search', [GeneratorReceiptController::class, 'search'])->name('admin.generatorReceipts.search');
                Route::post('/restore', [GeneratorReceiptController::class, 'restore'])->name('admin.generatorReceipts.restore');
            });

            Route::group(['prefix' => 'expense-generators'], function () {
                Route::get('/', [ExpenseGeneratorContoller::class, 'index'])->name('admin.generatorExpenses.index')->middleware('can:view_generator_expense');
                Route::get('/getIndex', [ExpenseGeneratorContoller::class, 'getIndex'])->name('admin.generatorExpenses.getIndex')->middleware('can:view_generator_expense');
                Route::post('/store', [ExpenseGeneratorContoller::class, 'store'])->name('admin.generatorExpenses.store')->middleware('can:add_generator_expense');
                Route::post('/update', [ExpenseGeneratorContoller::class, 'update'])->name('admin.generatorExpenses.update')->middleware('can:edit_generator_expense');
                Route::post('/delete', [ExpenseGeneratorContoller::class, 'delete'])->name('admin.generatorExpenses.delete')->middleware('can:delete_generator_expense');
                Route::get('/exportExcel', [ExpenseGeneratorContoller::class, 'exportExcel'])->name('admin.generatorExpenses.exportExcel');


            });
            Route::group(['prefix' => 'accounts'], function () {

                Route::group(['prefix' => 'trees'], function () {

                    Route::get('/', [TreeController::class, 'tree'])->name('admin.accounts.trees.index');
                    Route::post('/store', [TreeController::class, 'store'])->name('admin.accounts.trees.store')->middleware('can:add_asset');
                    Route::post('/storeChild', [TreeController::class, 'storeChild'])->name('admin.accounts.trees.storeChild');

                    Route::get('/getCode', [TreeController::class, 'getAccountChildCode'])->name('admin.accounts.getAccountChildCode');

                    Route::get('/getAccountCode', [TreeController::class, 'getAccountCode'])->name('admin.accounts.getAccountCode');
                    Route::get('/pdf', [TreeController::class, 'pdf'])->name('admin.accounts.pdf')->middleware('can:add_asset');
                });

                Route::group(['prefix' => 'tranactions'], function () {

                    Route::get('/', [TransactionContoller::class, 'index'])->name('admin.accounts.tranactions.index');
                    Route::get('/getIndex', [TransactionContoller::class, 'getIndex'])->name('admin.accounts.transactions.getIndex');
                });
                Route::group(['prefix' => 'meeting-rooms'], function () {
                    Route::get('/', [MettingRoomController::class, 'index'])->name('admin.meetingRooms.index');
                    Route::get('/getIndex', [MettingRoomController::class, 'getIndex'])->name('admin.meetingRooms.getIndex');
                    Route::post('/store', [MettingRoomController::class, 'store'])->name('admin.meetingRooms.store');
                    Route::post('/update', [MettingRoomController::class, 'update'])->name('admin.meetingRooms.update');
                    Route::post('/delete', [MettingRoomController::class, 'delete'])->name('admin.meetingRooms.delete');
                });

                Route::group(['prefix' => 'assets'], function () {

                    Route::get('/', [AssetsController::class, 'index'])->name('admin.accounts.assets.index')->middleware('can:view_asset');
                    Route::get('/getIndex', [AssetsController::class, 'getIndex'])->name('admin.accounts.assets.getIndex')->middleware('can:view_asset');
                    Route::post('/store', [AssetsController::class, 'store'])->name('admin.accounts.assets.store')->middleware('can:add_asset');
                    Route::post('/update', [AssetsController::class, 'update'])->name('admin.accounts.assets.update')->middleware('can:edit_asset');
                    Route::post('/delete', [AssetsController::class, 'delete'])->name('admin.accounts.assets.delete')->middleware('can:delete_asset');
                });

                Route::group(['prefix' => 'equities'], function () {

                    Route::get('/', [EquityController::class, 'index'])->name('admin.accounts.equities.index')->middleware('can:view_equity');
                    Route::get('/getIndex', [EquityController::class, 'getIndex'])->name('admin.accounts.equities.getIndex')->middleware('can:view_equity');
                    Route::post('/store', [EquityController::class, 'store'])->name('admin.accounts.equities.store')->middleware('can:add_equity');
                    Route::post('/update', [EquityController::class, 'update'])->name('admin.accounts.equities.update')->middleware('can:edit_equity');
                    Route::post('/delete', [EquityController::class, 'delete'])->name('admin.accounts.equities.delete')->middleware('can:delete_equity');
                });
                Route::group(['prefix' => 'liabilities'], function () {

                    Route::get('/', [LiabilitiesController::class, 'index'])->name('admin.accounts.liabilities.index')->middleware('can:view_liability');
                    Route::get('/getIndex', [LiabilitiesController::class, 'getIndex'])->name('admin.accounts.liabilities.getIndex')->middleware('can:view_liability');
                    Route::post('/store', [LiabilitiesController::class, 'store'])->name('admin.accounts.liabilities.store')->middleware('can:add_liability');
                    Route::post('/update', [LiabilitiesController::class, 'update'])->name('admin.accounts.liabilities.update')->middleware('can:edit_liability');
                    Route::post('/delete', [LiabilitiesController::class, 'delete'])->name('admin.accounts.liabilities.delete')->middleware('can:delete_liability');
                });

                Route::group(['prefix' => 'expenses'], function () {

                    Route::get('/', [ExpensesController::class, 'index'])->name('admin.accounts.expenses.index');
                    Route::get('/getIndex', [ExpensesController::class, 'getIndex'])->name('admin.accounts.expenses.getIndex');
                    Route::post('/store', [ExpensesController::class, 'store'])->name('admin.accounts.expenses.store');
                    Route::post('/update', [ExpensesController::class, 'update'])->name('admin.accounts.expenses.update');
                    Route::post('/delete', [ExpensesController::class, 'delete'])->name('admin.accounts.expenses.delete');
                });





                Route::group(['prefix' => 'users'], function () {

                    Route::get('/', [AccountUserController::class, 'index'])->name('admin.accounts.users.index')->middleware('can:view_liability');
                    Route::get('/getIndex', [AccountUserController::class, 'getIndex'])->name('admin.accounts.users.getIndex')->middleware('can:view_liability');
                    Route::post('/store', [AccountUserController::class, 'store'])->name('admin.accounts.users.store')->middleware('can:add_liability');
                    Route::post('/update', [AccountUserController::class, 'update'])->name('admin.accounts.users.update')->middleware('can:edit_liability');
                    Route::post('/delete', [AccountUserController::class, 'delete'])->name('admin.accounts.users.delete')->middleware('can:delete_liability');
                    Route::get('/userSerach', [AccountUserController::class, 'getUsersSerach'])->name('admin.accounts.users.getUsersSerach')->middleware('can:delete_liability');
                });
            });

            Route::group(['prefix' => 'work-space-mangemnts'], function () {

                //..
                Route::group(['prefix' => 'services'], function () {
                    Route::get('/', [ServiceController::class, 'index'])->name('admin.workSpaceManagments.services.index')->middleware('can:view_service');
                    Route::get('/getIndex', [ServiceController::class, 'getIndex'])->name('admin.workSpaceManagments.services.getIndex')->middleware('can:view_service');
                    Route::post('/store', [ServiceController::class, 'store'])->name('admin.workSpaceManagments.services.store')->middleware('can:add_service');
                    Route::post('/update', [ServiceController::class, 'update'])->name('admin.workSpaceManagments.services.update')->middleware('can:edit_service');
                    Route::post('/delete', [ServiceController::class, 'delete'])->name('admin.workSpaceManagments.services.delete')->middleware('can:delete_service');
                });
                Route::group(['prefix' => 'work-spaces'], function () {

                    Route::get('/', [WorkSpaceController::class, 'index'])->name('admin.workSpaceManagments.workSpaces.index')->middleware('can:view_work_space');
                    Route::get('/getIndex', [WorkSpaceController::class, 'getIndex'])->name('admin.workSpaceManagments.workSpaces.getIndex')->middleware('can:view_work_space');
                    Route::post('/store', [WorkSpaceController::class, 'store'])->name('admin.workSpaceManagments.workSpaces.store')->middleware('can:add_work_space');
                    Route::post('/update', [WorkSpaceController::class, 'update'])->name('admin.workSpaceManagments.workSpaces.update')->middleware('can:edit_work_space');
                    Route::post('/delete', [WorkSpaceController::class, 'delete'])->name('admin.workSpaceManagments.workSpaces.delete')->middleware('can:delete_work_space');
                    Route::post('/AddDeskMangment', [WorkSpaceController::class, 'AddDeskMangment'])->name('admin.workSpaceManagments.workSpaces.AddDeskMangment')->middleware('can:add_desk_mangment');
                });



                Route::group(['prefix' => 'desk-mangments'], function () {

                    Route::get('/', [DeskMangmentsControlller::class, 'index'])->name('admin.workSpaceManagments.deskManagments.index')->middleware('can:view_desk_mangment');
                    Route::get('/getIndex', [DeskMangmentsControlller::class, 'getIndex'])->name('admin.workSpaceManagments.deskManagments.getIndex')->middleware('can:view_desk_mangment');
                    Route::post('/store', [DeskMangmentsControlller::class, 'store'])->name('admin.workSpaceManagments.deskManagments.store')->middleware('can:add_desk_mangment');
                    Route::post('/update', [DeskMangmentsControlller::class, 'update'])->name('admin.workSpaceManagments.deskManagments.update')->middleware('can:edit_desk_mangment');
                    Route::post('/delete', [DeskMangmentsControlller::class, 'delete'])->name('admin.workSpaceManagments.deskManagments.delete')->middleware('can:delete_desk_mangment');
                    Route::get('/getCode', [DeskMangmentsControlller::class, 'getCode'])->name('admin.workSpaceManagments.deskManagments.getCode')->middleware('can:view_desk_mangment');

                    Route::get('/getCode', [DeskMangmentsControlller::class, 'getCode'])->name('admin.workSpaceManagments.deskManagments.getCode');
                    Route::get('/getWorkSpaces', [DeskMangmentsControlller::class, 'getWorkSpaces'])->name('admin.workSpaceManagments.deskManagments.getWorkSpaces');
                    Route::get('/getUsers', [DeskMangmentsControlller::class, 'getUsers'])->name('admin.workSpaceManagments.deskManagments.getUsers')->middleware('can:view_users');
                    Route::post('/release', [DeskMangmentsControlller::class, 'release'])->name('admin.workSpaceManagments.deskManagments.release')->middleware('can:view_service');
                    Route::post('/subscription', [DeskMangmentsControlller::class, 'subscriptionInternet'])->name('admin.workSpaceManagments.deskManagments.subscriptionInternet');
                    Route::get('/geDeskHistories', [DeskMangmentsControlller::class, 'getDeskHistories'])->name('admin.workSpaceManagments.deskManagments.geDeskHistories');
                    Route::get('/getUserDeskInfo', [DeskMangmentsControlller::class, 'getUserDeskInfo'])->name('admin.workSpaceManagments.deskManagments.getUserDeskInfo');
                });


                Route::group(['prefix' => 'room-mangments'], function () {

                    Route::get('/', [RoomMangmentsController::class, 'index'])->name('admin.workSpaceManagments.rooms.index')->middleware('can:view_room_mangment');
                    Route::get('/getIndex', [RoomMangmentsController::class, 'getIndex'])->name('admin.workSpaceManagments.rooms.getIndex')->middleware('can:view_room_mangment');
                    Route::post('/store', [RoomMangmentsController::class, 'store'])->name('admin.workSpaceManagments.rooms.store')->middleware('can:add_room_mangment');
                    Route::post('/update', [RoomMangmentsController::class, 'update'])->name('admin.workSpaceManagments.rooms.update')->middleware('can:edit_room_mangment');
                    Route::post('/delete', [RoomMangmentsController::class, 'delete'])->name('admin.workSpaceManagments.rooms.delete')->middleware('can:delete_room_mangment');
                    Route::get('/getCode', [RoomMangmentsController::class, 'getCode'])->name('admin.workSpaceManagments.rooms.getCode');
                    Route::get('/getWorkSpaces', [RoomMangmentsController::class, 'getWorkSpaces'])->name('admin.workSpaceManagments.rooms.getWorkSpaces');
                    Route::post('/release', [RoomMangmentsController::class, 'release'])->name('admin.workSpaceManagments.rooms.release')->middleware('can:release_room_mangment');
                    Route::get('/getUsers', [RoomMangmentsController::class, 'getUsers'])->name('admin.workSpaceManagments.rooms.getUsers');
                    Route::post('/postUsers', [RoomMangmentsController::class, 'postUsers'])->name('admin.workSpaceManagments.rooms.postUsers');
                    Route::get('/getRoomHistories', [RoomMangmentsController::class, 'getRoomHistories'])->name('admin.workSpaceManagments.rooms.getRoomHistories');
                    Route::post('/subscription', [RoomMangmentsController::class, 'subscriptionInternet'])->name('admin.workSpaceManagments.rooms.subscriptionInternet');
                    Route::post('/AddRooms', [RoomMangmentsController::class, 'AddRooms'])->name('admin.workSpaceManagments.rooms.AddRooms');
                });
            });





            Route::group(['prefix' => 'activities'], function () {

                Route::get('/', [ActivityController::class, 'index'])->name('admin.activities.index');
                Route::get('/getIndex', [ActivityController::class, 'getIndex'])->name('admin.activities.getIndex');
            });
            Route::group(['prefix' => 'withdraws'], function () {
                Route::get('/', [WithdrawsController::class, 'index'])->name('admin.withdraws.index');
                Route::get('getIndex', [WithdrawsController::class, 'getIndex'])->name('admin.withdraws.getIndex');
                Route::post('update', [WithdrawsController::class, 'update'])->name('admin.withdraws.update');
            });
        });
    }
);
