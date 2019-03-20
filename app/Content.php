<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Topic;

class Content extends Model
{
    //
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }
}
