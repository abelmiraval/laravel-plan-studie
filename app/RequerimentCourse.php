<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimentCourse extends Model
{
    //
    protected $table = 'requeriment_course';

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
