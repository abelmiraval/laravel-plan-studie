<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Course;

class Area extends Model
{
    //poner null el created_at u el updated_at
    // public $timestamps = false;
    protected $guarded = [];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
