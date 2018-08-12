<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $table = 'departments';
    protected $fillable = ['department'];
    protected $dates = ['deleted_at'];
}
