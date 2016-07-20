<?php

namespace Todolist;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{

    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $dateFormat = 'Y-m-d H:i:s O';


}
