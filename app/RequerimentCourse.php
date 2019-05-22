<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequerimentCourse extends Model
{
    //
    protected $table = 'requeriment_course';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    public function requeriment()
    {
        return $this->belongsTo(Course::class,'course_id_requeriment','id');
    }
}
