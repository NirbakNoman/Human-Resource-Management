<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeContact extends Model
{
    use SoftDeletes;
    protected $table = 'employee_contacts';
    protected $fillable = ['employee_id', 'present_address_street_one', 'present_address_street_two',
        'present_address_district', 'present_address_state', 'present_address_zip', 'permanent_address_street_one',
        'permanent_address_street_two', 'permanent_address_district', 'permanent_address_state',
        'permanent_address_zip', 'home_telephone','work_telephone', 'mobile', 'work_mail', 'other_mail'];
    protected $dates = ['deleted_at'];
}
