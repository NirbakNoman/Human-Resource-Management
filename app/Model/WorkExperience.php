<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkExperience extends Model
{
    use SoftDeletes;
    protected $table = 'work_experiences';
    public $fillable = ['employee_id', 'worked_company_name', 'worked_job_title', 'worked_from', 'worked_to', 'comments'];
    protected $dates = ['deleted_at'];

    /*  public function employee()
       {
           return $this->belongsTo('App\Employee','employee_id');
       }*/
}
