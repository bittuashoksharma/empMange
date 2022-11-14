<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api', 'employee'])->group(function () {
    Route::get('/get-user', [App\Http\Controllers\API\employee\EmpDetailControllers::class, 'getEmplyoeeDetail'])->name('empMain');
});


Route::middleware(['auth:api', 'admin'])->group(function () {

    Route::get('/admin/get-employee-profile-data/{empID}',[App\Http\Controllers\API\EmployeeControllers::class, 'getEmployeeprofileData']);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('{view}',App\Http\Controllers\HomeController::class)->where('view','(.*)');
    Route::post('/get-employee-preview-data/{empID}',[App\Http\Controllers\API\EmployeeControllers::class, 'getEmployeePreviewData']);
    //Route::get('/get-employee-profile-data/{empID}',[App\Http\Controllers\API\EmployeeControllers::class, 'getEmployeeprofileData']);

    Route::post('/get-filled-form-setup',[App\Http\Controllers\API\EmployeeControllers::class, 'getFilledFormSetup']);
    Route::post('/get-employee-personal-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'getEmployeePersonalDetail']);
    Route::post('/get-total-employee-count',[App\Http\Controllers\API\EmployeeControllers::class, 'getTotalEmployeeCount']);
    Route::post('/get-employee-company-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'getEmployeeCompanyDetail']);
    Route::post('/get-employee-financial-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'getEmployeeFinancialDetail']);
    Route::post('/get-employees',[App\Http\Controllers\API\EmployeeControllers::class, 'getEmployees']);


    Route::post('/add-employee-personal-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'storeEmployeePersonalDetail']);
    Route::post('/add-employee-company-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'storeEmployeeCompanyDetail']);
    Route::post('/add-employee-financial-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'storeEmployeeFinancialDetail']);
    Route::post('/add-employee-bank-account-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'storeEmployeeBankAccountDetail']);
    Route::post('/add-employee-document-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'storeEmployeeDocumentDetail']);
    Route::post('/add-employee-document-detail',[App\Http\Controllers\API\EmployeeControllers::class, 'storeEmployeeDocumentDetail']);
    Route::post('/create-offer-letter-pdf',[App\Http\Controllers\API\EmployeeControllers::class, 'createOfferLetterPdf']);


    Route::post('/setting-offer-letter',[App\Http\Controllers\API\SettingControllers::class, 'storeOfferLetterFormat']);
    Route::post('/get-offer-letter-format',[App\Http\Controllers\API\SettingControllers::class, 'getCompanyOfferLetterFormatDetail']);
    Route::post('/get-employee-offer-letter-content',[App\Http\Controllers\API\EmployeeControllers::class, 'getEmployeeOfferLetterContent']);
    Route::post('/store-employee-letter-datails',[App\Http\Controllers\API\EmployeeControllers::class, 'storeEmployeeLetterDetails']);
    Route::post('/add-allowances-and-deduction-list',[App\Http\Controllers\API\EmployeeControllers::class, 'getAllowancesAndDeductionList']);

    Route::post('/permissions', [App\Http\Controllers\API\PermissionsController::class,'storePermission']);
    Route::post('/get-permission',[App\Http\Controllers\API\PermissionsController::class, 'getPermission']);
    Route::post('/get-permission-list',[App\Http\Controllers\API\PermissionsController::class, 'getPermissionListing']);
    Route::post('/roles',[App\Http\Controllers\API\RolesController::class, 'storeRolePermission']);
    Route::post('/roles-permission-update',[App\Http\Controllers\API\RolesController::class, 'updateRolePermission']);
    Route::post('/get-role-listing',[App\Http\Controllers\API\RolesController::class, 'getRoleListing']);
    Route::post('/delete-roles/{id?}',[App\Http\Controllers\API\RolesController::class, 'deleteRole']);
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::post('forget-password', 'forgetPassword')->name('password.reset');
    Route::post('reset-password', 'resetPassword');

});