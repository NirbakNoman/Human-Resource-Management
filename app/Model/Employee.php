<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;
    protected $table = 'employees';

    public $fillable = ['first_name', 'middle_name', 'last_name', 'employee_code', 'national_id', 'date_of_birth', 'gender',
        'marital_status', 'passport_number', 'passport_expiry_date', 'driving_license_number', 'license_expiry_date'];

    protected $dates = ['deleted_at'];


    public function skills()
    {
        //dd($this->belongsToMany('App\Model\Skill')->withPivot('year_of_experiance','comments'));
        return $this->belongsToMany('App\Model\Skill')->withPivot('year_of_experiance','comments');
    }

    public function education()
    {
        return $this->belongsToMany('App\Model\Education','employee_education')->withPivot('institution_name','major','start_date','end_date','result');
    }

    public function languages()
    {
        return $this->belongsToMany('App\Model\Language','employee_language')->withPivot('fluency_type', 'competency_type', 'comments');
    }

/*    public function employeeDependent()
    {
        return $this->hasMany('App\EmployeeDependent','employee_id');
    }

    public function workExperiance()
    {
        return $this->hasMany('App\WorkExperiance','employee_id');
    }

    public function  employeeEmergencyContact()
    {
        return $this->hasOne('App\EmployeeEmergencyContact','employee_id');
    }

    public function employeeAttendance()
    {
        return $this->hasOne('App\Attendance','employee_id');
    }


    public function education()
    {
        return $this->belongsToMany('App\Education','education_employee','degree_id','employee_id');
    }

    public function language()
    {
        return $this->belongsToMany('App\Language','employee_language','language_id','employee_id');
    }

    public function skill()
    {
        return $this->belongsToMany('App\Skill','employee_skill','skill_id','employee_id');
    }

    public function license()
    {
        return $this->belongsToMany('App\License','employee_license','license_id','employee_id');
    }

    public function membership()
    {
        return $this->belongsToMany('App\Membership','employee_membership','membership_id','employee_id');
    }

    public function job()
    {
        return $this->belongsToMany('App\Job','employee_job','job_id','employee_id');
    }

    public function workShift()
    {
        return $this->belongsToMany('App\WorkShift','employee_work_shift','work_shift_id','employee_id');
    }

    public function leaveRequest()
    {
        return $this->belongsToMany('App\LeaveType','employee_leave_request','leave_type_id','employee_id');
    }

    public function leavePeriod()
    {
        return $this->belongsToMany('App\LeaveType','employee_leave_period','leave_type_id','employee_id');
    }*/
}
