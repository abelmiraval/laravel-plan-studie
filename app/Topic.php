<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Capacty;
use App\Content;

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
}
