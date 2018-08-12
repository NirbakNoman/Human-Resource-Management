<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobTitle extends Model
{
    use SoftDeletes;
    protected $table = 'job_titles';
    protected $fillable = ['job_title','department_id','job_title_code','description'];
    protected $dates = ['deleted_at'];
}
