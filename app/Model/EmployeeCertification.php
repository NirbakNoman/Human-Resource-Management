<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeCertification extends Model
{
    use SoftDeletes;
    protected $table = 'employee_certifications';
    protected $fillable = ['employee_id','certification','institute','granted_on','valid_till'];
    protected $dates = ['deleted_at'];
}
