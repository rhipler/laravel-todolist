<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;


    public function project()
    {
        return $this->belongsTo(Project::class,'projectid');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by')->withTrashed();
    }

    public function expendedTimes()
    {
        return $this->hasMany( ExpendedTime::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
