<?php

namespace Todolist;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    protected $dateFormat = 'Y-m-d H:i:s O';


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('Todolist\Role');
    }

    public function createdTasks()
    {
        $this->hasMany('Todolist\Task','created_by');
    }


}
