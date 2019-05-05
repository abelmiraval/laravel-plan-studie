<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Topic;

class Capacity extends Model
{
    //
    // public $timestamps = false;
    protected $guarded = [];
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
