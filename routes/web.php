<?php

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

use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employee',function(){
    return view('employee.employees');
});

//Route::get('/menu_delete/{id}', ['as'=>'menuDelete', 'uses'=>'Menus\menuController@deleteMenu'])->middleware('permission:admin_site-menu_delete');

//------------------------------------- Employee Personal Details -------------------------------------

Route::get('/employee_list',['as'=>'employeeList', 'uses'=> 'Employee\EmployeeController@employeeListGet']);

Route::get('/employee_add_form',['as'=>'employeeAddForm', 'uses'=> 'Employee\EmployeeController@employeeAddFormGet']);

Route::post('/employee_add_post',['as'=>'employeeAddPost', 'uses'=> 'Employee\EmployeeController@employeeAddFormPost']);

Route::get('/employee_delete/{id}',['as'=>'employeeDelete', 'uses'=> 'Employee\EmployeeController@deleteEmployee']);

Route::get('/edit_personal_detail_form/{id}',['as'=>'editPersonnelInfo', 'uses'=> 'Employee\EmployeeController@personnerDetailsGet']);

Route::post('/employee_personal_detail_post',['as'=>'personalDetailPost', 'uses'=> 'Employee\EmployeeController@personalDetailsPost']);

// --------------------------------------Employee Contact Routes ----------------------------------------------------

Route::get('/employee_contact/{id}',['as'=>'employeeContact', 'uses'=> 'EmployeeContact\EmployeeContactController@contactFormGet']);

Route::post('/employee_contact_edit_post',['as'=>'employeeContactEditPost', 'uses'=> 'EmployeeContact\EmployeeContactController@contactEditPost']);

//------------------------------------------ emergency contact routes --------------------------------------------------

Route::get('/emergency_contact/{id}',['as'=>'emergencyContact', 'uses'=> 'EmergencyContact\EmergencyContactController@emergencyContactGet']);

Route::post('/emergency_contact_add_post/{id}',['as'=>'emergencyContactAddPost', 'uses'=> 'EmergencyContact\EmergencyContactController@emergencyContactAddPost']);

Route::get('/emergency_contact_data/{id}',['as'=>'emergencyContactData', 'uses'=> 'EmergencyContact\EmergencyContactController@emergencyContactDataGet']);

Route::post('/emergency_contact_edit_post/{id}',['as'=>'emergencyContactEditPost', 'uses'=> 'EmergencyContact\EmergencyContactController@emergencyContactPost']);

Route::get('/emergency_contact_delete/{id}',['as'=>'emergencyContactDelete', 'uses'=> 'EmergencyContact\EmergencyContactController@deleteEmergencyContact']);

// ------------------------------- Employee Dependent Route --------------------------------------------

Route::get('/employee_dependent/{id}',['as'=>'employeeDependent', 'uses'=> 'EmployeeDependent\EmployeeDependentController@dependentFormGet']);

Route::post('/employee_dependent_add_post/{id}',['as'=>'employeeDependentAddPost', 'uses'=> 'EmployeeDependent\EmployeeDependentController@dependentAddPost']);

Route::get('/employee_dependent_data/{id}',['as'=>'employeeDependentData', 'uses'=> 'EmployeeDependent\EmployeeDependentController@dependentEditDataGet']);

Route::post('/employee_dependent_edit_post/{id}',['as'=>'employeeDependentEditPost', 'uses'=> 'EmployeeDependent\EmployeeDependentController@dependentEditPost']);

Route::get('/employee_dependent_delete/{id}',['as'=>'employeeDependentDelete', 'uses'=> 'EmployeeDependent\EmployeeDependentController@deleteDependent']);

// ------------------------------- Employee Work Experience Routes ------------------------------------------

Route::get('/work_experience/{id}',['as'=>'workExperience', 'uses'=> 'EmployeeWorkExperience\workExperienceController@workExperienceFormGet']);

Route::post('/work_experience_add_post/{id}',['as'=>'workExperienceAddPost', 'uses'=> 'EmployeeWorkExperience\workExperienceController@workExperienceAddPost']);

Route::get('/work_experience_data/{id}',['as'=>'workExperienceData', 'uses'=> 'EmployeeWorkExperience\workExperienceController@workExperienceEditDataGet']);

Route::post('/work_experience_edit_post/{id}',['as'=>'workExperienceEditPost', 'uses'=> 'EmployeeWorkExperience\workExperienceController@workExperienceEditPost']);

Route::get('/work_experience_delete/{id}',['as'=>'workExperienceDelete', 'uses'=> 'EmployeeWorkExperience\workExperienceController@deleteWorkExperience']);

// ----- ------------------------------- Employee Certification Routes -----------------------------

Route::get('/employee_certification/{id}',['as'=>'employeeCertification', 'uses'=> 'EmployeeCertification\employeeCertificationController@certificationFormGet']);

Route::post('/employee_certification_add_post/{id}',['as'=>'employeeCertificationAddPost', 'uses'=> 'EmployeeCertification\employeeCertificationController@certificationAddPost']);

Route::get('/employee_certification_data/{id}',['as'=>'employeeCertificationData', 'uses'=> 'EmployeeCertification\employeeCertificationController@certificationEditDataGet']);

Route::post('/employee_certification_edit_post/{id}',['as'=>'employeeCertificationEditPost', 'uses'=> 'EmployeeCertification\employeeCertificationController@certificationEditPost']);

Route::get('/employee_certification_delete/{id}',['as'=>'employeeCertificationDelete', 'uses'=> 'EmployeeCertification\employeeCertificationController@deleteCertification']);

// --------------------- Employee Skill Routes -----------------------------------------------------------------

Route::get('/employee_skill/{id}',['as'=>'employeeSkill', 'uses'=> 'EmployeeSkill\EmployeeSkillController@employeeSkillFormGet']);

Route::post('/employee_skill_add_post/{id}',['as'=>'employeeSkillAddPost', 'uses'=> 'EmployeeSkill\EmployeeSkillController@employeeSkillAddPost']);

Route::post('/employee_skill_data/{id}',['as'=>'employeeSkillData', 'uses'=> 'EmployeeSkill\EmployeeSkillController@employeeSkillEditDataGet']);

Route::post('/employee_skill_edit_post/{id}',['as'=>'employeeSkillEditPost', 'uses'=> 'EmployeeSkill\EmployeeSkillController@employeeSkillEditPost']);

Route::post('/employee_skill_delete/{id}',['as'=>'employeeSkillDelete', 'uses'=> 'EmployeeSkill\EmployeeSkillController@deleteEmployeeSkill']);

// ---------------------------------------- Employee Education Routes ----------------------------------------

Route::get('/employee_education/{id}',['as'=>'employeeEducation', 'uses'=> 'EmployeeEducation\EmployeeEducationController@employeeEducationFormGet']);

Route::post('/employee_education_add_post/{id}',['as'=>'employeeEducationAddPost', 'uses'=> 'EmployeeEducation\EmployeeEducationController@employeeEducationAddPost']);

Route::post('/employee_education_data/{id}',['as'=>'employeeEducationData', 'uses'=> 'EmployeeEducation\EmployeeEducationController@employeeEducationEditDataGet']);

Route::post('/employee_education_edit_post/{id}',['as'=>'employeeEducationEditPost', 'uses'=> 'EmployeeEducation\EmployeeEducationController@employeeEducationEditPost']);

Route::post('/employee_education_delete/{id}',['as'=>'employeeEducationDelete', 'uses'=> 'EmployeeEducation\EmployeeEducationController@deleteEmployeeEducation']);

// -------------------------------- Employee Language Routes -----------------------------------------

Route::get('/employee_language/{id}',['as'=>'employeeLanguage', 'uses'=> 'EmployeeLanguage\EmployeeLanguageController@employeeLanguageFormGet']);

Route::post('/employee_language_add_post/{id}',['as'=>'employeeLanguageAddPost', 'uses'=> 'EmployeeLanguage\EmployeeLanguageController@employeeLanguageAddPost']);

Route::post('/employee_language_data/{id}',['as'=>'employeeLanguageData', 'uses'=> 'EmployeeLanguage\EmployeeLanguageController@employeeLanguageEditDataGet']);

Route::post('/employee_language_edit_post/{id}',['as'=>'employeeLanguageEditPost', 'uses'=> 'EmployeeLanguage\EmployeeLanguageController@employeeLanguageEditPost']);

Route::post('/employee_language_delete/{id}',['as'=>'employeeLanguageDelete', 'uses'=> 'EmployeeLanguage\EmployeeLanguageController@deleteEmployeeLanguage']);

// ----------------------------------- skill Set Up --------------------------------------------------------

Route::get('/skill_list',['as'=>'skillList','uses'=>'QualificationSettings\SkillController@skillListGet']);

Route::post('/skill_add',['as'=>'skillAdd','uses'=>'QualificationSettings\SkillController@addSkill']);

Route::get('/skill_delete/{id}', ['as'=>'skillDelete', 'uses'=>'QualificationSettings\SkillController@deleteSkill']);

Route::get('/skill_edit_data/{id}', ['as'=>'skillEdit', 'uses'=>'QualificationSettings\SkillController@getSkillResponse']);

Route::post('/skill_edit_post/{id}','QualificationSettings\SkillController@editSkillPost')->name('editSkillPost');

// ----------------------------------------------- language Set Up Routes ----------------------------------

Route::get('/language_list',['as'=>'languageList','uses'=>'QualificationSettings\LanguageController@languageListGet']);

Route::post('/language_add',['as'=>'languageAdd','uses'=>'QualificationSettings\LanguageController@addLanguage']);

Route::get('/language_delete/{id}', ['as'=>'languageDelete', 'uses'=>'QualificationSettings\LanguageController@deleteLanguage']);

Route::get('/language_edit_data/{id}', ['as'=>'languageEdit', 'uses'=>'QualificationSettings\LanguageController@getLanguageResponse']);

Route::post('/language_edit_post/{id}','QualificationSettings\LanguageController@editLanguagePost')->name('editLanguagePost');

// ----------------------------  Education Set Up Routes -----------------------------------------------------

Route::get('/education_list',['as'=>'educationList','uses'=>'QualificationSettings\EducationController@educationListGet']);

Route::post('/education_add',['as'=>'educationAdd','uses'=>'QualificationSettings\EducationController@addEducation']);

Route::get('/education_delete/{id}', ['as'=>'educationDelete', 'uses'=>'QualificationSettings\EducationController@deleteEducation']);

Route::get('/education_edit_data/{id}', ['as'=>'educationEdit', 'uses'=>'QualificationSettings\EducationController@getEducationResponse']);

Route::post('/education_edit_post/{id}','QualificationSettings\EducationController@editEducationPost')->name('editEducationPost');

// ------------------------------------ Start Job Section ---------------------------------------

// ------------------------------------- Department Routes -------------------------------------

Route::get('/department_list',['as'=>'departmentList','uses'=>'JobDetailSetUp\DepartmentController@departmentListGet']);

Route::post('/department_add',['as'=>'departmentAdd','uses'=>'JobDetailSetUp\DepartmentController@addDepartment']);

Route::get('/department_edit_data/{id}', ['as'=>'departmentEditData', 'uses'=>'JobDetailSetUp\DepartmentController@getDepartmentData']);

Route::post('/department_edit_data_post/{id}', ['as' =>'editDepartmentDataPost', 'uses' =>'JobDetailSetUp\DepartmentController@editDepartmentDataPost']);

Route::get('/department_delete/{id}', ['as'=>'departmentDelete', 'uses'=>'JobDetailSetUp\DepartmentController@deleteDepartment']);

// --------------------------------- End of Department Routes ---------------------------------------------------------

// ------------------------------------- Job title Set Up Routes -----------------------------------------------

Route::get('/job_title_list',['as'=>'jobTitleList','uses'=>'JobDetailSetUp\JobTitleController@jobTitleListGet']);

Route::post('/job_title_add',['as'=>'jobTitleAdd','uses'=>'JobDetailSetUp\JobTitleController@addJobTitle']);

Route::get('/job_title_edit_data/{id}', ['as'=>'jobTitleEditData', 'uses'=>'JobDetailSetUp\JobTitleController@getJobTitleData']);

Route::post('/job_title_edit_data_post/{id}', ['as' =>'editJobTitleDataPost', 'uses' =>'JobDetailSetUp\JobTitleController@editJobTitleDataPost']);

Route::get('/job_title_delete/{id}', ['as'=>'jobTitleDelete', 'uses'=>'JobDetailSetUp\JobTitleController@deleteJobTitle']);

// ------------------------------------ End of Job title Set Up Routes -----------------------------------------------

// ---------------------------------------- End Job Section  -----------------------------------------------------------

