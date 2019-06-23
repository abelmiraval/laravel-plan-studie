<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class CourseTopic extends Model
{
    //
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
