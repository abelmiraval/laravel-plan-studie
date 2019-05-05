<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Topic;

class Content extends Model
{
    //
    protected $guarded = [];
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
