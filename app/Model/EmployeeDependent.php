<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployeeDependent extends Model
{
    protected $table = 'employee_dependents';
    public $fillable = ['employee_id', 'dependent_name', 'relationship_with_employee', 'dependent_date_of_birth'];
    protected $dates = ['deleted_at'];

    public function employeePersonnelDetail()
    {
        return $this->belongsTo('App\Employee','employee_id');
    }

}
