<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\TaskCompleted;
use App\Models\User;
use Illuminate\Support\Facades\Notification;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
          
});
Route::get('markasread', function () {

    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
   })->name('markread');

Auth::routes();

Route::group ( [
    'middleware' => 'auth',
],function () {



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('lang/{locale}', [App\Http\Controllers\HomeController::class, 'lngcng']);

Route::get('lang/{locale}', [App\Http\Controllers\UsersController::class, 'index']);

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dasboard');

Route::post('/mark-as-read', [App\Http\Controllers\HomeController::class, 'markNotification'])->name('mark-as-read');



Route::get('/view-user', [App\Http\Controllers\UsermanagementController::class, 'viewUser'])->name('view-user');
Route::get('/add-user', [App\Http\Controllers\UsermanagementController::class, 'addUser'])->name('add-user');
Route::get('/submit_user', [App\Http\Controllers\UsermanagementController::class, 'registerUser'])->name('submit_user');
Route::get('/deleteuser/{id}', [App\Http\Controllers\UsermanagementController::class, 'deleteuser'])->name('deleteuser');
Route::get('/edit-user/{id}', [App\Http\Controllers\UsermanagementController::class, 'edituser'])->name('edit-user');
Route::get('/update-user/{id}', [App\Http\Controllers\UsermanagementController::class, 'updateuser'])->name('update-user');
Route::post('update-pass/{id}', [App\Http\Controllers\UsermanagementController::class,'updatePass'])->name('update-pass');

Route::get('/view-role', [App\Http\Controllers\RoleController::class, 'viewrole'])->name('view-role');
Route::get('/add-role', [App\Http\Controllers\RoleController::class, 'addRole'])->name('add-role');
Route::get('/submit_new_role', [App\Http\Controllers\RoleController::class, 'registerRole'])->name('submit_new_role');
Route::get('/deleterole/{id}', [App\Http\Controllers\RoleController::class, 'deleterole'])->name('deleterole');
Route::get('/edit-role/{id}', [App\Http\Controllers\RoleController::class, 'editRole'])->name('edit-role');
Route::get('/update-role/{id}', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('update-role');


Route::get('/view-sub-role', [App\Http\Controllers\SubroleController::class, 'viewsubrole'])->name('view-sub-role');
Route::get('/add-sub-role', [App\Http\Controllers\SubroleController::class, 'addsubrole'])->name('add-sub-role');
Route::get('/submit_role', [App\Http\Controllers\SubroleController::class, 'submitrole'])->name('submit_role');
Route::get('/deletesubrole/{id}', [App\Http\Controllers\SubroleController::class, 'deletesubrole'])->name('deletesubrole');
Route::get('/edit-sub-role/{id}', [App\Http\Controllers\SubroleController::class, 'editsubRole'])->name('edit-sub-role');
Route::get('/update-sub-role/{id}', [App\Http\Controllers\SubroleController::class, 'updatesubrole'])->name('update-sub-role');


Route::resource('/configurations', ConfigurationController::class); 

Route::get('/all-nationality', [App\Http\Controllers\NationalityController::class, 'viewnationality'])->name('all-nationality');
Route::get('/add-nationality', [App\Http\Controllers\NationalityController::class, 'addNationality'])->name('add-nationality');
Route::get('/submit_new_nationality', [App\Http\Controllers\NationalityController::class, 'registerNationality'])->name('submit_new_nationality');
Route::get('/deletenationality/{id}', [App\Http\Controllers\NationalityController::class, 'deletenationality'])->name('deletenationality');
Route::get('/edit-Nationality/{id}', [App\Http\Controllers\NationalityController::class, 'editNationality'])->name('edit-Nationality');
Route::get('/update-Nationality/{id}', [App\Http\Controllers\NationalityController::class, 'updateNationality'])->name('update-Nationality');

Route::get('/all-religion', [App\Http\Controllers\ReligionController::class, 'viewallReligion'])->name('all-religion');
Route::get('/add-religion', [App\Http\Controllers\ReligionController::class, 'addReligion'])->name('add-religion');
Route::get('/submit_new_religion', [App\Http\Controllers\ReligionController::class, 'registerReligion'])->name('submit_new_religion');
Route::get('/deletereligion/{id}', [App\Http\Controllers\ReligionController::class, 'deletereligion'])->name('deletereligion');
Route::get('/edit-Religion/{id}', [App\Http\Controllers\ReligionController::class, 'editReligion'])->name('edit-Religion');
Route::get('/update-Religion/{id}', [App\Http\Controllers\ReligionController::class, 'updateReligion'])->name('update-Religion');


Route::get('/all-feedback', [App\Http\Controllers\FeedbackController::class, 'viewallfeedback'])->name('all-feedback');
Route::get('/add-feedback', [App\Http\Controllers\FeedbackController::class, 'addfeedback'])->name('add-feedback');
Route::get('/submit_feedback', [App\Http\Controllers\FeedbackController::class, 'submitfeedback'])->name('submit_feedback');
Route::get('/deletefeedback/{id}', [App\Http\Controllers\FeedbackController::class, 'deletefeedback'])->name('deletefeedback');
Route::get('/edit-feedback/{id}', [App\Http\Controllers\FeedbackController::class, 'editfeedback'])->name('edit-feedback');
Route::get('/update-feedback/{id}', [App\Http\Controllers\FeedbackController::class, 'updatefeedback'])->name('update-feedback');


//leave-all-master
Route::get('/add-leave-period', [App\Http\Controllers\ConfigureController::class, 'addleaveperiod'])->name('add-leave-period');
Route::get('/submit_leave_period', [App\Http\Controllers\ConfigureController::class, 'submitleaveperiod'])->name('submit_leave_period');
Route::get('/view-leave-period', [App\Http\Controllers\ConfigureController::class, 'viewleaveperiod'])->name('view-leave-period');
Route::get('/leave-period/{id}', [App\Http\Controllers\ConfigureController::class, 'editleaveperiod'])->name('leave-period');
Route::get('/submit_leave/{id}', [App\Http\Controllers\ConfigureController::class, 'submitLeave'])->name('submit_leave');
Route::get('/view-leave-type', [App\Http\Controllers\ConfigureController::class, 'viewleavetype'])->name('view-leave-type');
Route::get('/add-leave-type', [App\Http\Controllers\ConfigureController::class, 'addleavetype'])->name('add-leave-type');
Route::get('/submit_leave_type', [App\Http\Controllers\ConfigureController::class, 'submitleavetype'])->name('submit_leave_type');
Route::get('/deleteleavetype/{id}', [App\Http\Controllers\ConfigureController::class, 'deleteleavetype'])->name('deleteleavetype');
Route::get('/edit-leave-type/{id}', [App\Http\Controllers\ConfigureController::class, 'editleavetype'])->name('edit-leave-type');
Route::get('/update-leave-type/{id}', [App\Http\Controllers\ConfigureController::class, 'updateleavetype'])->name('update-leave-type');
Route::get('/view-work-week', [App\Http\Controllers\ConfigureController::class, 'viewworkweek'])->name('view-work-week');
Route::get('/edit-work-week/{id}', [App\Http\Controllers\ConfigureController::class, 'editworkweek'])->name('edit-work-week');
Route::get('/update-work-week/{id}', [App\Http\Controllers\ConfigureController::class, 'updateworkweek'])->name('update-work-week');
Route::get('/deleteleaveperiod/{id}', [App\Http\Controllers\ConfigureController::class, 'deleteleaveperiod'])->name('deleteleaveperiod');


Route::get('/view-holiday', [App\Http\Controllers\ConfigureController::class, 'viewholiday'])->name('view-holiday');
Route::get('/add-holiday', [App\Http\Controllers\ConfigureController::class, 'addholiday'])->name('add-holiday');
Route::get('/submit_holiday', [App\Http\Controllers\ConfigureController::class, 'submitholiday'])->name('submit_holiday');
Route::get('/deleteholiday/{id}', [App\Http\Controllers\ConfigureController::class, 'deleteholiday'])->name('deleteholiday');
Route::get('/edit-holiday/{id}', [App\Http\Controllers\ConfigureController::class, 'editholiday'])->name('edit-holiday');
Route::get('/update-holiday/{id}', [App\Http\Controllers\ConfigureController::class, 'updateholiday'])->name('update-holiday');


Route::get('/view-leave-travel-concession-type', [App\Http\Controllers\LeaveTravelConcessionTypeController::class, 'viewleavetravelconcessiontype'])->name('view-leave-travel-concession-type');
Route::get('/add-leave-travel-concession-type', [App\Http\Controllers\LeaveTravelConcessionTypeController::class, 'addleavetravelconcessiontype'])->name('add-leave-travel-concession-type');
Route::get('/submit-leave-travel-concession-type', [App\Http\Controllers\LeaveTravelConcessionTypeController::class, 'submitleavetravelconcessiontype'])->name('submit-leave-travel-concession-type');
Route::get('/delete-leave-travel-concession-type/{id}', [App\Http\Controllers\LeaveTravelConcessionTypeController::class, 'deleteleavetravelconcessiontype'])->name('delete-leave-travel-concession-type');
Route::get('/edit-leave-travel-concession-type/{id}', [App\Http\Controllers\LeaveTravelConcessionTypeController::class, 'editleavetravelconcessiontype'])->name('edit-leave-travel-concession-type');
Route::get('/update-leave-travel-concession-type/{id}', [App\Http\Controllers\LeaveTravelConcessionTypeController::class, 'updateleavetravelconcessiontype'])->name('update-leave-travel-concession-type');

//ltcapplication
Route::get('/view-leave-travel-apply', [App\Http\Controllers\LeaveTravelApplicationController::class, 'viewleavetravelapply'])->name('view-leave-travel-apply');
Route::get('/add-leave-travel-apply', [App\Http\Controllers\LeaveTravelApplicationController::class, 'addleavetravelapply'])->name('add-leave-travel-apply');
Route::post('/submit-leave-travel-apply', [App\Http\Controllers\LeaveTravelApplicationController::class, 'submitleavetravelapply'])->name('submit-leave-travel-apply');
Route::get('/edit-leave-travel-apply/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'editleavetravelapply'])->name('edit-leave-travel-apply');
Route::post('/update-leave-travel-apply/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'updateleavetravelapply'])->name('update-leave-travel-apply');

Route::post('/leave-travel-apply-approve/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'leavetravelapprove'])->name('leave-travel-apply-approve');
Route::post('/leave-travel-apply-paid/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'leavetravelpaid'])->name('leave-travel-apply-paid');

Route::get('/view-ltc-member/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'viewltcmember'])->name('view-ltc-member');

Route::get('/view-all-ltc-member/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'viewallltcmember'])->name('view-all-ltc-member');
Route::get('/add-ltc-member/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'addltcmember'])->name('add-ltc-member');
Route::post('/submit-ltc-member/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'submitltcmember'])->name('submit-ltc-member');
Route::get('/view-leave-travel-apply-details/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'viewleavetraveldetails'])->name('view-leave-travel-apply-details');



Route::get('/getemployee/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'getemployee']);
Route::get('/getemployeetype/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'getemployeetype']);
Route::get('/getemployeejoining/{id}', [App\Http\Controllers\LeaveTravelApplicationController::class, 'getemployeetype']);


//leave  
Route::get('/leave', [App\Http\Controllers\LeaveController::class, 'index'])->name('leave');
Route::get('/leave/create', [App\Http\Controllers\LeaveController::class, 'create'])->name('leave.create');
Route::post('/leave/store', [App\Http\Controllers\LeaveController::class, 'store'])->name('leave.store');
Route::get('/leave/search', [App\Http\Controllers\LeaveController::class, 'search'])->name('leave.search');
Route::post('/leave/approve/{id}', [App\Http\Controllers\LeaveController::class, 'approve'])->name('leave.approve');
Route::post('/leave/paid/{id}', [App\Http\Controllers\LeaveController::class, 'paid'])->name('leave.paid');
Route::get('/view-leave-details/{id}', [App\Http\Controllers\LeaveController::class, 'viewleavedetails'])->name('view-leave-details');


Route::post('/total-leave', [App\Http\Controllers\AllleaveController::class, 'allleave'])->name('total-leave');
Route::get('/view-all-leave', [App\Http\Controllers\AllleaveController::class, 'viewleaves'])->name('view-all-leave');

Route::get('/view-my-leave-entitlement', [App\Http\Controllers\EntitlementController::class, 'viewmyleaveentitlement'])->name('view-my-leave-entitlement');
Route::get('/view-leave-entitlement', [App\Http\Controllers\EntitlementController::class, 'viewleaveentitlement'])->name('view-leave-entitlement');
Route::get('/add-leave-entitlement', [App\Http\Controllers\EntitlementController::class, 'addleaveentitlement'])->name('add-leave-entitlement');
Route::get('/submit_leave_entitlement', [App\Http\Controllers\EntitlementController::class, 'submitleaveentitlement'])->name('submit_leave_entitlement');
Route::get('/deleteleaveentitlement/{id}', [App\Http\Controllers\EntitlementController::class, 'deleteleaveentitlement'])->name('deleteleaveentitlement');
Route::get('/edit-leave-entitlement/{id}', [App\Http\Controllers\EntitlementController::class, 'editleaveentitlement'])->name('edit-leave-entitlement');
Route::get('/update-leave-entitlement/{id}', [App\Http\Controllers\EntitlementController::class, 'updateleaveentitlement'])->name('update-leave-entitlement');


//employee
Route::get('/view-employee', [App\Http\Controllers\EmployeeController::class, 'viewemployee'])->name('view-employee');
Route::get('/add-employee', [App\Http\Controllers\EmployeeController::class, 'addemployee'])->name('add-employee');
Route::post('/submit_employee', [App\Http\Controllers\EmployeeController::class, 'submitemployee'])->name('submit_employee.post');
Route::get('/deleteemployee/{id}', [App\Http\Controllers\EmployeeController::class, 'deleteemployee'])->name('deleteemployee');
Route::get('/edit-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployee'])->name('edit-employee');
Route::post('/update-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployee'])->name('update-employee');

Route::get('/addemployeetab', [App\Http\Controllers\EmployeeController::class, 'addemployeetab'])->name('addemployeetab');
Route::get('/edit-employeetab/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeetab'])->name('edit-employeetab');

Route::get('/add-employee/getrole/{id}', [App\Http\Controllers\EmployeeController::class, 'getrole']);
Route::get('/add-employee/getlocation/{id}', [App\Http\Controllers\EmployeeController::class, 'getlocation']);
Route::get('/getunit/{id}', [App\Http\Controllers\EmployeeController::class, 'getunit']);

Route::get('/getdistrict/{id}', [App\Http\Controllers\EmployeeController::class, 'getdistrict']);

Route::get('/edit-employee/getldlocation/{ld_id}', [App\Http\Controllers\EmployeeController::class, 'getldlocation']);
Route::get('/getldlocation/getldunit/{ld_id}', [App\Http\Controllers\EmployeeController::class, 'getldunit']);

Route::get('/details-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'detailsemployee'])->name('details-employee');;

//company-location-subunit
Route::get('/view-company', [App\Http\Controllers\CompanyGenInfoController::class, 'viewcompany'])->name('view-company');
Route::get('/add-company', [App\Http\Controllers\CompanyGenInfoController::class, 'addcompany'])->name('add-company');
Route::post('/submit_company', [App\Http\Controllers\CompanyGenInfoController::class, 'submitcompany'])->name('submit_company');
Route::get('/deletecompany/{id}', [App\Http\Controllers\CompanyGenInfoController::class, 'deletecompany'])->name('deletecompany');
Route::get('/edit-company/{id}', [App\Http\Controllers\CompanyGenInfoController::class, 'editcompany'])->name('edit-company');
Route::get('/update-company/{id}', [App\Http\Controllers\CompanyGenInfoController::class, 'updatecompany'])->name('update-company');
 
Route::get('/view-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'viewlocation'])->name('view-location');

Route::get('/view-company-location', [App\Http\Controllers\CompanyLocationController::class, 'viewcompanylocation'])->name('view-company-location');
Route::get('/add-company-location', [App\Http\Controllers\CompanyLocationController::class, 'addcompanylocation'])->name('add-company-location');
Route::get('/submit_company_location', [App\Http\Controllers\CompanyLocationController::class, 'submitcompanylocation'])->name('submit_company_location');
Route::get('/deletecompany-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'deletecompanylocation'])->name('deletecompany-location');
Route::get('/edit-company-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'editcompanylocation'])->name('edit-company-location');
Route::get('/update-company-location/{id}', [App\Http\Controllers\CompanyLocationController::class, 'updatecompanylocation'])->name('update-company-location');
 

Route::get('/view-location-subunit/{id}', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'viewlocationsubunit'])->name('view-location-subunit');

Route::get('/view-company-location-subunit', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'viewcompanylocationsubunit'])->name('view-company-location-subunit');
Route::get('/add-company-location-subunit', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'addcompanylocationsubunit'])->name('add-company-location-subunit');
Route::get('/submit_company_location_subunit', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'submitcompanylocationsubunit'])->name('submit_company_location_subunit');
Route::get('/deletecompany-location-subunit/{id}', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'deletecompanylocationsubunit'])->name('deletecompany-location-subunit');
Route::get('/edit-company-location-subunit/{id}', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'editcompanylocationsubunit'])->name('edit-company-location-subunit');
Route::get('/update-company-location-subunit/{id}', [App\Http\Controllers\CompanyLocationDepartmentController::class, 'updatecompanylocationsubunit'])->name('update-company-location-subunit');

//myprofile/myactivity
Route::get('/add-info-tab', [App\Http\Controllers\MyinfoController::class, 'addinfotab'])->name('add-info-tab');
Route::post('/my-info-tab-update', [App\Http\Controllers\MyinfoController::class, 'updateinfotab'])->name('my-info-tab-update');

Route::get('/my-remuneration', [App\Http\Controllers\MyinfoController::class, 'myremuneration'])->name('my-remuneration');

Route::get('/my-feedback', [App\Http\Controllers\MyinfoController::class, 'myfeedback'])->name('my-feedback');

Route::get('/my-attandance', [App\Http\Controllers\MyinfoController::class, 'myattandance'])->name('my-attandance');
Route::post('/attandance_time', [App\Http\Controllers\MyinfoController::class, 'attandancetime'])->name('attandance_time');

Route::get('/my-team', [App\Http\Controllers\MyinfoController::class, 'myteam'])->name('my-team');
Route::get('/my-team-view', [App\Http\Controllers\MyinfoController::class, 'myteamview'])->name('my-team-view');

Route::get('/my-training', [App\Http\Controllers\MyinfoController::class, 'mytraining'])->name('my-training');

Route::get('/my-exam-score', [App\Http\Controllers\MyinfoController::class, 'myexamscore'])->name('my-exam-score');

Route::get('/my-daily-report', [App\Http\Controllers\MyinfoController::class, 'mydailyreport'])->name('my-daily-report');

Route::get('/my-warning', [App\Http\Controllers\MyinfoController::class, 'mywarning'])->name('my-warning');
Route::get('/my-salary', [App\Http\Controllers\MyinfoController::class, 'mysalary'])->name('my-salary');

Route::get('/given-feedback', [App\Http\Controllers\MyinfoController::class, 'givenfeedback'])->name('given-feedback');

Route::get('/given-complain', [App\Http\Controllers\MyinfoController::class, 'givencomplain'])->name('given-complain');


//daily-attandance
Route::post('/daily-attandance-time', [App\Http\Controllers\AttandanceController::class, 'submitattandance'])->name('daily-attandance-time');
Route::get('/my-attandance-checkout', [App\Http\Controllers\MyinfoController::class, 'myattandancecheckout'])->name('my-attandance-checkout');
Route::post('/daily-attandance-out-time/{date}', [App\Http\Controllers\AttandanceController::class, 'updateattandance'])->name('daily-attandance-out-time');
Route::get('/checkoutattandance/{id}', [App\Http\Controllers\AttandanceController::class, 'checkout'])->name('checkoutattandance');
Route::get('/add-attandance-review', [App\Http\Controllers\AttandanceController::class, 'addattandancereview'])->name('add-attandance-review');
Route::get('/view-attandance-review', [App\Http\Controllers\AttandanceController::class, 'viewattandancereview'])->name('view-attandance-review');
Route::post('/submit_attandance_review', [App\Http\Controllers\AttandanceController::class, 'submitattandancereview'])->name('submit_attandance_review');
Route::get('/get-attandance-all', [App\Http\Controllers\HomeController::class, 'getattandance'])->name('get-attandance-all');


//workshift-master
Route::get('/view-workshift', [App\Http\Controllers\WorkshiftController::class, 'viewworkshift'])->name('view-workshift');
Route::get('/add-workshift', [App\Http\Controllers\WorkshiftController::class, 'addworkshift'])->name('add-workshift');
Route::get('/submit_workshift', [App\Http\Controllers\WorkshiftController::class, 'submitworkshift'])->name('submit_workshift');
Route::get('/deleteworkshift/{id}', [App\Http\Controllers\WorkshiftController::class, 'deleteworkshift'])->name('deleteworkshift');
Route::get('/edit-workshift/{id}', [App\Http\Controllers\WorkshiftController::class, 'editworkshift'])->name('edit-workshift');
Route::get('/update-workshift/{id}', [App\Http\Controllers\WorkshiftController::class, 'updateworkshift'])->name('update-workshift');
 
//education-master
Route::get('/view-education', [App\Http\Controllers\QualificationController::class, 'vieweducation'])->name('view-education');
Route::get('/add-education', [App\Http\Controllers\QualificationController::class, 'addeducation'])->name('add-education');
Route::get('/submit_education', [App\Http\Controllers\QualificationController::class, 'submiteducation'])->name('submit_education');
Route::get('/deleteeducation/{id}', [App\Http\Controllers\QualificationController::class, 'deleteeducation'])->name('deleteeducation');
Route::get('/edit-education/{id}', [App\Http\Controllers\QualificationController::class, 'editeducation'])->name('edit-education');
Route::get('/update-education/{id}', [App\Http\Controllers\QualificationController::class, 'updateeducation'])->name('update-education');
 //skills-master
Route::get('/view-skills', [App\Http\Controllers\QualificationController::class, 'viewskills'])->name('view-skills');
Route::get('/add-skills', [App\Http\Controllers\QualificationController::class, 'addskills'])->name('add-skills');
Route::get('/submit_skills', [App\Http\Controllers\QualificationController::class, 'submitskills'])->name('submit_skills');
Route::get('/deleteskills/{id}', [App\Http\Controllers\QualificationController::class, 'deleteskills'])->name('deleteskills');
Route::get('/edit-skills/{id}', [App\Http\Controllers\QualificationController::class, 'editskills'])->name('edit-skills');
Route::get('/update-skills/{id}', [App\Http\Controllers\QualificationController::class, 'updateskills'])->name('update-skills');
 
//employee-type
Route::get('/view-employee-type', [App\Http\Controllers\EmployeeTypeController::class, 'viewemployeetype'])->name('view-employee-type');
Route::get('/add-employee-type', [App\Http\Controllers\EmployeeTypeController::class, 'addemployeetype'])->name('add-employee-type');
Route::get('/submit_employee_type', [App\Http\Controllers\EmployeeTypeController::class, 'submitemployeetype'])->name('submit_employee_type');
Route::get('/deleteemployeetype/{id}', [App\Http\Controllers\EmployeeTypeController::class, 'deleteemployeetype'])->name('deleteemployeetype');
Route::get('/edit-employee-type/{id}', [App\Http\Controllers\EmployeeTypeController::class, 'editemployeetype'])->name('edit-employee-type');
Route::get('/update-employee-type/{id}', [App\Http\Controllers\EmployeeTypeController::class, 'updateemployeetype'])->name('update-employee-type');
 

Route::get('/home3', [App\Http\Controllers\EmployeeController::class, 'home3'])->name('home3');
Route::post('file-upload', [App\Http\Controllers\EmployeeController::class, 'fileUploadPost' ])->name('file.upload.post');

//pdf-generate
Route::get('generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF']);
Route::get('/add-warning', [App\Http\Controllers\PDFController::class, 'addwarning'])->name('add-warning');
Route::post('warning-generate', [App\Http\Controllers\PDFController::class, 'warninggenerate'])->name('warning-generate');;

Route::get('importExportView', [App\Http\Controllers\ExcelController::class, 'importExportView']);
Route::get('export', [App\Http\Controllers\ExcelController::class, 'export'])->name('export');
Route::post('import', [App\Http\Controllers\ExcelController::class, 'import'])->name('import');


Route::get('/view-language', [App\Http\Controllers\LanguageController::class, 'viewlanguage'])->name('view-language');
Route::get('/add-language', [App\Http\Controllers\LanguageController::class, 'addlanguage'])->name('add-language');
Route::get('/submit_language', [App\Http\Controllers\LanguageController::class, 'submitlanguage'])->name('submit_language');
Route::get('/deletelanguage/{id}', [App\Http\Controllers\LanguageController::class, 'deletelanguage'])->name('deletelanguage');
Route::get('/edit-language/{id}', [App\Http\Controllers\LanguageController::class, 'editlanguage'])->name('edit-language');
Route::get('/update-language/{id}', [App\Http\Controllers\LanguageController::class, 'updatelanguage'])->name('update-language');
 

Route::get('/view-assets', [App\Http\Controllers\AssetsController::class, 'viewassets'])->name('view-assets');
Route::get('/add-assets', [App\Http\Controllers\AssetsController::class, 'addassets'])->name('add-assets');
Route::get('/submit_assets', [App\Http\Controllers\AssetsController::class, 'submitassets'])->name('submit_assets');
Route::get('/deleteassets/{id}', [App\Http\Controllers\AssetsController::class, 'deleteassets'])->name('deleteassets');
Route::get('/edit-assets/{id}', [App\Http\Controllers\AssetsController::class, 'editassets'])->name('edit-assets');
Route::get('/update-assets/{id}', [App\Http\Controllers\AssetsController::class, 'updateassets'])->name('update-assets');
 



Route::post('/update-employee-info/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeinfo'])->name('update-employee-info');
Route::post('/update-employee-address/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeaddress'])->name('update-employee-address');
Route::post('/update-employee-salary/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeesalary'])->name('update-employee-salary');
Route::post('/update-employee-bank/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeebank'])->name('update-employee-bank');
Route::post('/update-employee-promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeepromotion'])->name('update-employee-promotion');
Route::post('/update-employee-image/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeimage'])->name('update-employee-image');
Route::post('/update-employee-personal/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeepersonal'])->name('update-employee-personal');
Route::post('/update-employee-teaminfo/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeteaminfo'])->name('update-employee-teaminfo');


Route::get('/addemployee-blood-doc/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeblooddoc'])->name('addemployee-blood-doc');
Route::post('/submit_employee_blood_doc/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeblooddoc'])->name('submit_employee_blood_doc');

Route::get('/addemployee-pan-doc/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployepancard'])->name('addemployee-pan-doc');
Route::post('/submit_employee_pan_doc/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeepancard'])->name('submit_employee_pan_doc');

Route::get('/addemployee-image/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeimage'])->name('addemployee-image');
Route::post('/submit_employee_image/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeimage'])->name('submit_employee_image');


Route::get('/addemployee-assets/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeeassets'])->name('addemployee-assets');
Route::post('/submit_employee_assets/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeassets'])->name('submit_employee_assets');
Route::get('/editemployee-assets/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeeassets'])->name('editemployee-assets');
Route::post('/update-employee-assets/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeassets'])->name('update-employee-assets');
Route::get('/deleteemployeeassets/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeeassets'])->name('deleteemployeeassets');

Route::get('/addemployee-family-info/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeefamilyinfo'])->name('addemployee-family-info');
Route::post('/submit-employee-family-info/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeefamilyinfo'])->name('submit-employee-family-info');
Route::get('/editemployee-family-info/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeefamilyinfo'])->name('editemployee-family-info');
Route::post('/update-family-info/{id}', [App\Http\Controllers\EmployeeController::class, 'updatefamilyinfo'])->name('update-family-info');
Route::get('/deleteemployee-family-info/{id}', [App\Http\Controllers\EmployeeController::class, 'deleteemployeefamilyinfo'])->name('deleteemployee-family-info');

Route::get('/addemployee-promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeepromotion'])->name('addemployee-promotion');
Route::post('/submit_employee_promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeepromotion'])->name('submit_employee_promotion');
Route::get('/editemployee-promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeepromotion'])->name('editemployee-promotion');
Route::post('/update-employee-promotion/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployepromotion'])->name('update-employee-promotion');
Route::get('/deleteemployeepromotion/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeepromotion'])->name('deleteemployeepromotion');

Route::get('/addemployee-addhar-doc/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeaddhardoc'])->name('addemployee-addhar-doc');
Route::post('/submit_employee_addhar_doc/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeaddhardoc'])->name('submit_employee_addhar_doc');

Route::get('/addemployee-disable-doc/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployedisabledoc'])->name('addemployee-disable-doc');
Route::post('/submit_employee_disable_doc/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeedisabledoc'])->name('submit_employee_disable_doc');

Route::get('/addemployee-caste-doc/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployecastedoc'])->name('addemployee-caste-doc');
Route::post('/submit_employee_caste_doc/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeecastedoc'])->name('submit_employee_caste_doc');


Route::get('/addemployee-skills/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeeskills'])->name('addemployee-skills');
Route::post('/submit_employee_skills/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeskills'])->name('submit_employee_skills');
Route::get('/editemployee-skills/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeeskills'])->name('editemployee-skills');
Route::post('/update-employee-skills/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeskills'])->name('update-employee-skills');
Route::get('/deleteemployeeskills/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeeskills'])->name('deleteemployeeskills');


Route::get('/addemployee-language/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeelanguage'])->name('addemployee-language');
Route::post('/submit_employee_language/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeelanguage'])->name('submit_employee_language');
Route::get('/editemployee-language/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeelanguage'])->name('editemployee-language');
Route::post('/update-employee-language/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeelanguage'])->name('update-employee-language');
Route::get('/deleteemployeelanguage/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeelanguage'])->name('deleteemployeelanguage');

Route::get('/addemployee-education/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeeeducation'])->name('addemployee-education');
Route::post('/submit_employee_education/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeeducation'])->name('submit_employee_education');
Route::get('/editemployee-education/{id}', [App\Http\Controllers\EmployeeController::class, 'editemployeeeducation'])->name('editemployee-education');
Route::post('/update-employee-education/{id}', [App\Http\Controllers\EmployeeController::class, 'updateemployeeeducation'])->name('update-employee-education');
Route::get('/deleteemployeeeducation/{id}', [App\Http\Controllers\AssetsController::class, 'deleteemployeeeducation'])->name('deleteemployeeeducation');
Route::get('/addemployee-edu-doc/{id}', [App\Http\Controllers\EmployeeController::class, 'addemployeedudoc'])->name('addemployee-edu-doc');
Route::post('/submit_employee_edu_doc/{id}', [App\Http\Controllers\EmployeeController::class, 'submitemployeeedudoc'])->name('submit_employee_edu_doc');

//state-master
Route::get('/view-state', [App\Http\Controllers\StateController::class, 'viewstate'])->name('view-state');
Route::get('/add-state', [App\Http\Controllers\StateController::class, 'addstate'])->name('add-state');
Route::get('/submit_state', [App\Http\Controllers\StateController::class, 'submitstate'])->name('submit_state');
Route::get('/deletestate/{id}', [App\Http\Controllers\StateController::class, 'deletestate'])->name('deletestate');
Route::get('/edit-state/{id}', [App\Http\Controllers\StateController::class, 'editstate'])->name('edit-state');
Route::get('/update-state/{id}', [App\Http\Controllers\StateController::class, 'updatestate'])->name('update-state');

//district-master
Route::get('/view-district', [App\Http\Controllers\DistrictController::class, 'viewdistrict'])->name('view-district');
Route::get('/add-district', [App\Http\Controllers\DistrictController::class, 'adddistrict'])->name('add-district');
Route::get('/submit_district', [App\Http\Controllers\DistrictController::class, 'submitdistrict'])->name('submit_district');
Route::get('/deletedistrict/{id}', [App\Http\Controllers\DistrictController::class, 'deletedistrict'])->name('deletedistrict');
Route::get('/edit-district/{id}', [App\Http\Controllers\DistrictController::class, 'editdistrict'])->name('edit-district');
Route::get('/update-district/{id}', [App\Http\Controllers\DistrictController::class, 'updatedistrict'])->name('update-district');

//country-master
Route::get('/view-country', [App\Http\Controllers\CountryController::class, 'viewcountry'])->name('view-country');
Route::get('/add-country', [App\Http\Controllers\CountryController::class, 'addcountry'])->name('add-country');
Route::get('/submit_country', [App\Http\Controllers\CountryController::class, 'submitcountry'])->name('submit_country');
Route::get('/deletecountry/{id}', [App\Http\Controllers\CountryController::class, 'deletecountry'])->name('deletecountry');
Route::get('/edit-country/{id}', [App\Http\Controllers\CountryController::class, 'editcountry'])->name('edit-country');
Route::get('/update-country/{id}', [App\Http\Controllers\CountryController::class, 'updatecountry'])->name('update-country');



//Complain Route
Route::get('/view-complain', [App\Http\Controllers\ComplainController::class, 'viewcomplain'])->name('view-complain');
Route::get('/add-complain', [App\Http\Controllers\ComplainController::class, 'addcomplain'])->name('add-complain');
Route::post('/submit_complain', [App\Http\Controllers\ComplainController::class, 'submitcomplain'])->name('submit_complain');
Route::get('/getcomplainuser/{id}', [App\Http\Controllers\ComplainController::class, 'getcomplainuser']);
Route::get('/getcomplainuserimage/{id}', [App\Http\Controllers\ComplainController::class, 'getcomplainuserimage']);


    //project
    Route::get('/add-project', [App\Http\Controllers\ProjectController::class, 'addproject'])->name('add-project');
    Route::post('/submit_project', [App\Http\Controllers\ProjectController::class, 'submitproject'])->name('submit_project');
    Route::get('/view-project', [App\Http\Controllers\ProjectController::class, 'viewproject'])->name('view-project');

   //employeefeedback

    Route::get('/view-all-employee-feedback', [App\Http\Controllers\FeedbackController::class, 'viewallemployeefeedback'])->name('view-all-employee-feedback');
    Route::get('/view-employee-feedback', [App\Http\Controllers\FeedbackController::class, 'viewemployeefeedback'])->name('view-employee-feedback');
    Route::get('/add-employee-feedback', [App\Http\Controllers\FeedbackController::class, 'givefeedback'])->name('add-employee-feedback');
    Route::post('/submit_employee_feedback', [App\Http\Controllers\FeedbackController::class, 'submitemployeefeedback'])->name('submit_employee_feedback');
   
    
    //subject-master
    Route::get('/view-subject', [App\Http\Controllers\SubjectController::class, 'viewsubject'])->name('view-subject');
    Route::get('/add-subject', [App\Http\Controllers\SubjectController::class, 'addsubject'])->name('add-subject');
    Route::get('/submit_subject', [App\Http\Controllers\SubjectController::class, 'submitsubject'])->name('submit_subject');
    Route::get('/deletesubject/{id}', [App\Http\Controllers\SubjectController::class, 'deletesubject'])->name('deletesubject');
    Route::get('/edit-subject/{id}', [App\Http\Controllers\SubjectController::class, 'editsubject'])->name('edit-subject');
    Route::get('/update-subject/{id}', [App\Http\Controllers\SubjectController::class, 'updatesubject'])->name('update-subject');
    
    //crm-master
    Route::get('/view-crm', [App\Http\Controllers\CRMController::class, 'viewcrm'])->name('view-crm');
    Route::get('/add-crm', [App\Http\Controllers\CRMController::class, 'addcrm'])->name('add-crm');
    Route::get('/submit_crm', [App\Http\Controllers\CRMController::class, 'submitcrm'])->name('submit_crm');
    Route::get('/deletecrm/{id}', [App\Http\Controllers\CRMController::class, 'deletecrm'])->name('deletecrm');
    Route::get('/edit-crm/{id}', [App\Http\Controllers\CRMController::class, 'editcrm'])->name('edit-crm');
    Route::get('/update-crm/{id}', [App\Http\Controllers\CRMController::class, 'updatecrm'])->name('update-crm');
    
    //jobcategory-master
    Route::get('/view-jobcategory', [App\Http\Controllers\JobcategoryController::class, 'viewjobcategory'])->name('view-jobcategory');
    Route::get('/add-jobcategory', [App\Http\Controllers\JobcategoryController::class, 'addjobcategory'])->name('add-jobcategory');
    Route::get('/submit_jobcategory', [App\Http\Controllers\JobcategoryController::class, 'submitjobcategory'])->name('submit_jobcategory');
    Route::get('/deletejobcategory/{id}', [App\Http\Controllers\JobcategoryController::class, 'deletejobcategory'])->name('deletejobcategory');
    Route::get('/edit-jobcategory/{id}', [App\Http\Controllers\JobcategoryController::class, 'editjobcategory'])->name('edit-jobcategory');
    Route::get('/update-jobcategory/{id}', [App\Http\Controllers\JobcategoryController::class, 'updatejobcategory'])->name('update-jobcategory');
    
    //jobtype-master
    Route::get('/view-jobtype', [App\Http\Controllers\JobtypeController::class, 'viewjobtype'])->name('view-jobtype');
    Route::get('/add-jobtype', [App\Http\Controllers\JobtypeController::class, 'addjobtype'])->name('add-jobtype');
    Route::get('/submit_jobtype', [App\Http\Controllers\JobtypeController::class, 'submitjobtype'])->name('submit_jobtype');
    Route::get('/deletejobtype/{id}', [App\Http\Controllers\JobtypeController::class, 'deletejobtype'])->name('deletejobtype');
    Route::get('/edit-jobtype/{id}', [App\Http\Controllers\JobtypeController::class, 'editjobtype'])->name('edit-jobtype');
    Route::get('/update-jobtype/{id}', [App\Http\Controllers\JobtypeController::class, 'updatejobtype'])->name('update-jobtype');
    
    //daily-report
    Route::get('/view-daily-report', [App\Http\Controllers\DailyReportController::class, 'viewdailyreport'])->name('view-daily-report');
    Route::get('/add-daily-report', [App\Http\Controllers\DailyReportController::class, 'adddailyreport'])->name('add-daily-report');
    Route::post('/submit-daily-report', [App\Http\Controllers\DailyReportController::class, 'submitdailyreport'])->name('submit-daily-report');
    
    //employee-training
    Route::get('/view-employeetraining', [App\Http\Controllers\EmployeeTrainingController::class, 'viewemployeetraining'])->name('view-employeetraining');
    Route::get('/add-employeetraining', [App\Http\Controllers\EmployeeTrainingController::class, 'addemployeetraining'])->name('add-employeetraining');
    Route::post('/submit-employeetraining', [App\Http\Controllers\EmployeeTrainingController::class, 'submitemployeetraining'])->name('submit-employeetraining');
    
    //employee-examscore
    Route::get('/view-employeeexamscore', [App\Http\Controllers\EmployeeExamScoreController::class, 'viewemployeeexamscore'])->name('view-employeeexamscore');
    Route::get('/add-employeeexamscore', [App\Http\Controllers\EmployeeExamScoreController::class, 'addemployeeexamscore'])->name('add-employeeexamscore');
    Route::post('/submit-employeeexamscore', [App\Http\Controllers\EmployeeExamScoreController::class, 'submitemployeeexamscore'])->name('submit-employeeexamscore');
    
//employee-examscore
Route::get('/view-all-notification', [App\Http\Controllers\ViewNotificationController::class, 'viewallnotification'])->name('view-all-notification');
Route::get('/view-new-notification', [App\Http\Controllers\ViewNotificationController::class, 'viewnewnotification'])->name('view-new-notification');

//employee-warning
Route::get('/view-all-warning', [App\Http\Controllers\WarningController::class, 'viewallwarning'])->name('view-all-warning');

//announcements
Route::get('/add-announcements', [App\Http\Controllers\AnnouncementsController::class, 'addannouncement'])->name('add-announcements');
Route::get('/view-announcements', [App\Http\Controllers\AnnouncementsController::class, 'viewannouncement'])->name('view-announcements');
Route::get('/is-active/{val}/{status}', [App\Http\Controllers\AnnouncementsController::class, 'changeActive']);
Route::get('/getannouncementuser/{lid}/{did}', [App\Http\Controllers\AnnouncementsController::class, 'getannouncementuser']);
Route::get('/getannouncementrole/{id}', [App\Http\Controllers\AnnouncementsController::class, 'getannouncementrole']);
Route::get('/getlocationid/{id}', [App\Http\Controllers\AnnouncementsController::class, 'getlocationid']);

Route::post('/announcement', [App\Http\Controllers\AnnouncementsController::class, 'postAnnouncement'])->name('announcement');


//salary

//salary-master-slab
Route::get('/view-salary-slab', [App\Http\Controllers\SalarySlabController::class, 'viewsalaryslab'])->name('view-salary-slab');
Route::get('/add-salary-slab', [App\Http\Controllers\SalarySlabController::class, 'addsalaryslab'])->name('add-salary-slab');
Route::get('/submit-salary-slab', [App\Http\Controllers\SalarySlabController::class, 'submitsalaryslab'])->name('submit-salary-slab');
Route::get('/delete-salary-slab/{id}', [App\Http\Controllers\SalarySlabController::class, 'deletesalaryslab'])->name('delete-salary-slab');
Route::get('/edit-salary-slab/{id}', [App\Http\Controllers\SalarySlabController::class, 'editsalaryslab'])->name('edit-salary-slab');
Route::get('/update-salary-slab/{id}', [App\Http\Controllers\SalarySlabController::class, 'updatesalaryslab'])->name('update-salary-slab');

//salary
Route::get('/view-all-salary', [App\Http\Controllers\SalaryDetailsController::class, 'viewallsalary'])->name('view-all-salary');
Route::get('/add-salary', [App\Http\Controllers\SalaryDetailsController::class, 'addsalary'])->name('add-salary');
Route::post('/submit_salary', [App\Http\Controllers\SalaryDetailsController::class, 'submitsalary'])->name('submit_salary');
Route::get('/view-salary-details', [App\Http\Controllers\SalaryDetailsController::class, 'viewsalarydetails'])->name('view-salary-details');
Route::post('/store-salary-details/{id}', [App\Http\Controllers\SalaryDetailsController::class, 'storesalarydetails'])->name('store-salary-details');
Route::get('/getsalary/{id}', [App\Http\Controllers\SalaryDetailsController::class, 'getsalary']);
Route::get('/getdue/{id}', [App\Http\Controllers\SalaryDetailsController::class, 'getdue']);
//bank
Route::get('/view-banks', [App\Http\Controllers\BankMasterController::class, 'viewbanks'])->name('view-banks');
Route::get('/add-banks', [App\Http\Controllers\BankMasterController::class, 'addbanks'])->name('add-banks');
Route::get('/submit_banks', [App\Http\Controllers\BankMasterController::class, 'submitbanks'])->name('submit_banks');
Route::get('/deletebanks/{id}', [App\Http\Controllers\BankMasterController::class, 'deletebanks'])->name('deletebanks');
Route::get('/edit-banks/{id}', [App\Http\Controllers\BankMasterController::class, 'editbanks'])->name('edit-banks');
Route::get('/update-banks/{id}', [App\Http\Controllers\BankMasterController::class, 'updatebanks'])->name('update-banks');
 
//advance-loan-type-master
Route::get('/view-advancetype', [App\Http\Controllers\AdvanceLoanTypeController::class, 'viewadvancetype'])->name('view-advancetype');
Route::get('/add-advancetype', [App\Http\Controllers\AdvanceLoanTypeController::class, 'addadvancetype'])->name('add-advancetype');
Route::get('/submit-advancetype', [App\Http\Controllers\AdvanceLoanTypeController::class, 'submitadvancetype'])->name('submit-advancetype');
Route::get('/delete-advancetype/{id}', [App\Http\Controllers\AdvanceLoanTypeController::class, 'deleteadvancetype'])->name('delete-advancetype');
Route::get('/edit-advancetype/{id}', [App\Http\Controllers\AdvanceLoanTypeController::class, 'editadvancetype'])->name('edit-advancetype');
Route::get('/update-advancetype/{id}', [App\Http\Controllers\AdvanceLoanTypeController::class, 'updateadvancetype'])->name('update-advancetype');

//teamhandover
Route::get('/view-teamhandover', [App\Http\Controllers\TeamHandoverController::class, 'viewteamhandover'])->name('view-teamhandover');
Route::get('/add-teamhandover', [App\Http\Controllers\TeamHandoverController::class, 'addteamhandover'])->name('add-teamhandover');
Route::post('/submit_teamhandover', [App\Http\Controllers\TeamHandoverController::class, 'submitteamhandover'])->name('submit_teamhandover');
Route::get('/deleteteamhandover/{id}', [App\Http\Controllers\TeamHandoverController::class, 'deleteteamhandover'])->name('deleteteamhandover');
Route::get('/edit-teamhandover/{id}', [App\Http\Controllers\TeamHandoverController::class, 'editteamhandover'])->name('edit-teamhandover');
Route::post('/update-teamhandover/{id}', [App\Http\Controllers\TeamHandoverController::class, 'updateteamhandover'])->name('update-teamhandover');
 
//jobshift
Route::get('/view-jobshift', [App\Http\Controllers\JobShiftController::class, 'viewjobshift'])->name('view-jobshift');
Route::get('/add-jobshift', [App\Http\Controllers\JobShiftController::class, 'addjobshift'])->name('add-jobshift');
Route::post('/submit_jobshift', [App\Http\Controllers\JobShiftController::class, 'submitjobshift'])->name('submit_jobshift');
Route::get('/deletejobshift/{id}', [App\Http\Controllers\JobShiftController::class, 'deletejobshift'])->name('deletejobshift');
Route::get('/edit-jobshift/{id}', [App\Http\Controllers\JobShiftController::class, 'editjobshift'])->name('edit-jobshift');
Route::post('/update-jobshift/{id}', [App\Http\Controllers\JobShiftController::class, 'updatejobshift'])->name('update-jobshift');
 
//grade-master
Route::get('/view-grade-master', [App\Http\Controllers\GradeMasterController::class, 'viewgrademaster'])->name('view-grade-master');
Route::get('/add-grade-master', [App\Http\Controllers\GradeMasterController::class, 'addgrademaster'])->name('add-grade-master');
Route::get('/submit-grade-master', [App\Http\Controllers\GradeMasterController::class, 'submitgrademaster'])->name('submit-grade-master');
Route::get('/delete-grade-master/{id}', [App\Http\Controllers\GradeMasterController::class, 'deletegrademaster'])->name('delete-grade-master');
Route::get('/edit-grade-master/{id}', [App\Http\Controllers\GradeMasterController::class, 'editgrademaster'])->name('edit-grade-master');
Route::get('/update-grade-master/{id}', [App\Http\Controllers\GradeMasterController::class, 'updategrademaster'])->name('update-grade-master');


//all-doc
Route::get('/view-all-doc', [App\Http\Controllers\AllDocController::class, 'viewalldoc'])->name('view-all-doc');

Route::get('/view-pan-doc', [App\Http\Controllers\AllDocController::class, 'viewpandoc'])->name('view-pan-doc');
Route::get('/view-blood-doc', [App\Http\Controllers\AllDocController::class, 'viewblooddoc'])->name('view-blood-doc');
Route::get('/view-promotion-doc', [App\Http\Controllers\AllDocController::class, 'viewpromotiondoc'])->name('view-promotion-doc');
Route::get('/view-edu-doc-certificate', [App\Http\Controllers\AllDocController::class, 'viewedudoccertificate'])->name('view-edu-doc-certificate');


//certificatea-attestation
Route::get('/view-certificateattestation', [App\Http\Controllers\CertificateAttestationController::class, 'viewcertificateattestation'])->name('view-certificateattestation');
Route::get('/add-certificateattestation', [App\Http\Controllers\CertificateAttestationController::class, 'addcertificateattestation'])->name('add-certificateattestation');
Route::post('/submit-certificateattestation', [App\Http\Controllers\CertificateAttestationController::class, 'submitcertificateattestation'])->name('submit-certificateattestation');
Route::get('/delete-certificateattestation/{id}', [App\Http\Controllers\CertificateAttestationController::class, 'deletecertificateattestation'])->name('delete-certificateattestation');
Route::get('/edit-certificateattestation/{id}', [App\Http\Controllers\CertificateAttestationController::class, 'editcertificateattestation'])->name('edit-certificateattestation');
Route::post('/update-certificateattestation/{id}', [App\Http\Controllers\CertificateAttestationController::class, 'updatecertificateattestation'])->name('update-certificateattestation');
Route::get('/view-certificateattestation-details/{id}', [App\Http\Controllers\CertificateAttestationController::class, 'viewcertificateattestationdetails'])->name('view-certificateattestation-details');
Route::post('/certificateattestation-hr-approve/{id}', [App\Http\Controllers\CertificateAttestationController::class, 'certificateattestationhrapprove'])->name('certificateattestation-hr-approve');


//service-details
Route::get('/view-servicedetails', [App\Http\Controllers\ServiceDetailsController::class, 'viewservicedetails'])->name('view-servicedetails');
Route::get('/add-servicedetails', [App\Http\Controllers\ServiceDetailsController::class, 'addservicedetails'])->name('add-servicedetails');
Route::post('/submit-servicedetails', [App\Http\Controllers\ServiceDetailsController::class, 'submitservicedetails'])->name('submit-servicedetails');
Route::get('/delete-servicedetails/{id}', [App\Http\Controllers\ServiceDetailsController::class, 'deleteservicedetails'])->name('delete-servicedetails');
Route::get('/edit-servicedetails/{id}', [App\Http\Controllers\ServiceDetailsController::class, 'editservicedetails'])->name('edit-servicedetails');
Route::post('/update-servicedetails/{id}', [App\Http\Controllers\ServiceDetailsController::class, 'updateservicedetails'])->name('update-servicedetails');
Route::post('/servicedetails-hr-approve/{id}', [App\Http\Controllers\ServiceDetailsController::class, 'servicedetailshrapprove'])->name('servicedetails-hr-approve');


//add-nomination-insurance
Route::get('/view-addnominationinsurance', [App\Http\Controllers\AddNominationController::class, 'viewaddnominationinsurance'])->name('view-addnominationinsurance');
Route::get('/add-addnominationinsurance', [App\Http\Controllers\AddNominationController::class, 'addaddnominationinsurance'])->name('add-addnominationinsurance');
Route::post('/submit-addnominationinsurance', [App\Http\Controllers\AddNominationController::class, 'submitaddnominationinsurance'])->name('submit-addnominationinsurance');
Route::get('/delete-addnominationinsurance/{id}', [App\Http\Controllers\AddNominationController::class, 'deleteaddnominationinsurance'])->name('delete-addnominationinsurance');
Route::get('/edit-addnominationinsurance/{id}', [App\Http\Controllers\AddNominationController::class, 'editaddnominationinsurance'])->name('edit-addnominationinsurance');
Route::post('/update-addnominationinsurance/{id}', [App\Http\Controllers\AddNominationController::class, 'updateaddnominationinsurance'])->name('update-addnominationinsurance');
Route::get('/view-addinsurance', [App\Http\Controllers\AddNominationController::class, 'viewaddinsurance'])->name('view-addinsurance');
Route::post('/grpinsurance-hr-approve/{id}', [App\Http\Controllers\AddNominationController::class, 'grpinsurancehrapprove'])->name('grpinsurance-hr-approve');
Route::post('/nominationinsurance-hr-approve/{id}', [App\Http\Controllers\AddNominationController::class, 'nominationinsurancehrapprove'])->name('nominationinsurance-hr-approve');


//ta-da-entitlement-master
Route::get('/view-tadaentitlement', [App\Http\Controllers\TaDaEntitlementController::class, 'viewtadaentitlement'])->name('view-tadaentitlement');
Route::get('/add-tadaentitlement', [App\Http\Controllers\TaDaEntitlementController::class, 'addtadaentitlement'])->name('add-tadaentitlement');
Route::post('/submit-tadaentitlement', [App\Http\Controllers\TaDaEntitlementController::class, 'submittadaentitlement'])->name('submit-tadaentitlement');
Route::get('/delete-tadaentitlement/{id}', [App\Http\Controllers\TaDaEntitlementController::class, 'deletetadaentitlement'])->name('delete-tadaentitlement');
Route::get('/edit-tadaentitlement/{id}', [App\Http\Controllers\TaDaEntitlementController::class, 'edittadaentitlement'])->name('edit-tadaentitlement');
Route::post('/update-tadaentitlement/{id}', [App\Http\Controllers\TaDaEntitlementController::class, 'updatetadaentitlement'])->name('update-tadaentitlement');

Route::get('/view-employee-nomini', [App\Http\Controllers\AddNominationController::class, 'viewemployeenomini'])->name('view-employee-nomini');
Route::get('/add-employee-nomini', [App\Http\Controllers\AddNominationController::class, 'addemployeenomini'])->name('add-employee-nomini');
Route::post('/update-employee-nomini', [App\Http\Controllers\AddNominationController::class, 'updateemployeenomini'])->name('update-employee-nomini');
Route::post('/employeenomini-admin-approve/{id}', [App\Http\Controllers\AddNominationController::class, 'employeenominiadminapprove'])->name('employeenomini-admin-approve');


//ta-da
Route::get('/view-employeetada', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'viewemployeetada'])->name('view-employeetada');
Route::get('/add-employeetada', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'addemployeetada'])->name('add-employeetada');
Route::post('/submit-employeetada', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'submitemployeetada'])->name('submit-employeetada');
Route::get('/delete-employeetada/{id}', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'deleteemployeetada'])->name('delete-employeetada');
Route::get('/edit-employeetada/{id}', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'editemployeetada'])->name('edit-employeetada');
Route::post('/update-employeetada/{id}', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'updateemployeetada'])->name('update-employeetada');
Route::get('/view-employeetada-details/{id}', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'viewemployeetadadetails'])->name('view-employeetada-details');
Route::post('/employeetada-admin-approve/{id}', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'employeetadaadminapprove'])->name('employeetada-admin-approve');
Route::post('/employeetada-dir-approve/{id}', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'employeetadadirapprove'])->name('employeetada-dir-approve');

Route::get('/getentitlementname/{id}', [App\Http\Controllers\EmployeeTaDaDetailsController::class, 'getentitlementname']);

//vaccine-master
Route::get('/view-vaccine-master', [App\Http\Controllers\VaccineController::class, 'viewvaccinemaster'])->name('view-vaccine-master');
Route::get('/add-vaccine-master', [App\Http\Controllers\VaccineController::class, 'addvaccinemaster'])->name('add-vaccine-master');
Route::post('/submit-vaccine-master', [App\Http\Controllers\VaccineController::class, 'submitvaccinemaster'])->name('submit-vaccine-master');
Route::get('/delete-vaccine-master/{id}', [App\Http\Controllers\VaccineController::class, 'deletevaccinemaster'])->name('delete-vaccine-master');
Route::get('/edit-vaccine-master/{id}', [App\Http\Controllers\VaccineController::class, 'editvaccinemaster'])->name('edit-vaccine-master');
Route::get('/update-vaccine-master/{id}', [App\Http\Controllers\VaccineController::class, 'updatevaccinemaster'])->name('update-vaccine-master');

//vaccine-employee
Route::get('/view-vaccine-employee', [App\Http\Controllers\VaccineController::class, 'viewvaccineemployee'])->name('view-vaccine-employee');
Route::get('/add-vaccine-employee', [App\Http\Controllers\VaccineController::class, 'addvaccineemployee'])->name('add-vaccine-employee');
Route::post('/submit-vaccine-employee', [App\Http\Controllers\VaccineController::class, 'submitvaccineemployee'])->name('submit-vaccine-employee');
Route::get('/delete-vaccine-employee/{id}', [App\Http\Controllers\VaccineController::class, 'deletevaccineemployee'])->name('delete-vaccine-employee');
Route::get('/edit-vaccine-employee/{id}', [App\Http\Controllers\VaccineController::class, 'editvaccineemployee'])->name('edit-vaccine-employee');
Route::get('/update-vaccine-employee/{id}', [App\Http\Controllers\VaccineController::class, 'updatevaccineemployee'])->name('update-vaccine-employee');


Route::get('/view-employeeclaim', [App\Http\Controllers\EmployeeClaimController::class, 'viewemployeeclaim'])->name('view-employeeclaim');
Route::get('/add-employeeclaim', [App\Http\Controllers\EmployeeClaimController::class, 'addemployeeclaim'])->name('add-employeeclaim');
Route::post('/submit-employeeclaim', [App\Http\Controllers\EmployeeClaimController::class, 'submitemployeeclaim'])->name('submit-employeeclaim');
Route::get('/delete-employeeclaim/{id}', [App\Http\Controllers\EmployeeClaimController::class, 'deleteemployeeclaim'])->name('delete-employeeclaim');
Route::get('/edit-employeeclaim/{id}', [App\Http\Controllers\EmployeeClaimController::class, 'editemployeeclaim'])->name('edit-employeeclaim');
Route::post('/update-employeeclaim/{id}', [App\Http\Controllers\EmployeeClaimController::class, 'updateemployeeclaim'])->name('update-employeeclaim');
Route::get('/view-employeeclaim-details/{id}', [App\Http\Controllers\EmployeeClaimController::class, 'viewemployeeclaimdetails'])->name('view-employeeclaim-details');
Route::post('/employeeclaim-admin-approve/{id}', [App\Http\Controllers\EmployeeClaimController::class, 'employeeclaimadminapprove'])->name('employeeclaim-admin-approve');
Route::post('/employeeclaim-dir-approve/{id}', [App\Http\Controllers\EmployeeClaimController::class, 'employeeclaimdirapprove'])->name('employeeclaim-dir-approve');



} );


