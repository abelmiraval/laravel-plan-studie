<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;


class Plan extends Model
{
    //
    protected $guarded = [];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
