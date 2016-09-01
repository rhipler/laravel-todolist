<?php

namespace Todolist;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $dateFormat = 'Y-m-d H:i:s O';


    public function project()
    {
        return $this->belongsTo('Todolist\project','projectid');
    }

    public function createdByUser()
    {
        return $this->belongsTo('Todolist\User', 'created_by')->withTrashed();
    }

    public function expendedTimes()
    {
        return $this->hasMany('Todolist\ExpendedTime');
    }

    public function comments()
    {
        return $this->hasMany('Todolist\Comment');
    }


}
