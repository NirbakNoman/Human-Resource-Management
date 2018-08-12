<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;
    protected $table = 'education';
    protected $fillable = ['education_level'];
    protected $dates = ['deleted_at'];
}
