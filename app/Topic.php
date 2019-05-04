<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Capacity;
use App\Content;
use App\Course;

class Topic extends Model
{
    //

    public function capacities()
    {
        return $this->belongsToMany(Capacity::class);
    }

    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
