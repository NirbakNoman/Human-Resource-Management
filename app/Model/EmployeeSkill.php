<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeSkill extends Model
{
    use SoftDeletes;
    protected $table = 'employee_skill';
    public $fillable = ['employee_id', 'skill_id', 'year_of_experiance', 'comments'];
    protected $dates = ['deleted_at'];

   /* public function skill()
    {
        return $this->belongsTo('App\Model\Skill');
        //return $this->hasMany('App\Model\Skill','id','skill_id');
    }*/
}
