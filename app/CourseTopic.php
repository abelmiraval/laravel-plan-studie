<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class CourseTopic extends Model
{
    //
<<<<<<< HEAD
    protected $table = 'course_topic';

=======
>>>>>>> b72282011d0c23cbdde8f860d26489db66ad9ead
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
