<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use SoftDeletes;
    protected $table = 'skills';
    protected $fillable = ['name','description'];
    protected $dates = ['deleted_at'];

    public function employee()
    {
        return $this->belongsToMany('App\Model\Employee');
    }


}
