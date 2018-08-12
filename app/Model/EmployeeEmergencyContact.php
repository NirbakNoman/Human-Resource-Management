<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeEmergencyContact extends Model
{
    use SoftDeletes;
    protected $table = 'employee_emergency_contacts';
    public $fillable = ['employee_id', 'contact_name', 'contact_relation', 'contact_home_telephone', 'contact_mobile'];
    protected $dates = ['deleted_at'];

    public function employeePersonnelDetail()
    {
        return $this->belongsTo('App\Employee','employee_id');
    }
}
