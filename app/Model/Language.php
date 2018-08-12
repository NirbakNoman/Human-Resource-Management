<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use SoftDeletes;
    protected $table = 'languages';
    protected $fillable = ['name'];
    protected $dates = ['deleted_at'];
}
