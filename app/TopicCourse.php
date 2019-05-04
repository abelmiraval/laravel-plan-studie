<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopicCourse extends Model
{
    //
    protected $table = 'topic_course';

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
