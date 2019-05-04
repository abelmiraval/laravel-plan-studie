<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Area;
use App\Nature;
use App\Term;
use App\Topic;

class Course extends Model
{
    //
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function nature()
    {
        return $this->belongsTo(Nature::class);
    }

    public function term()
    {
        return $this->belongsTo(Term::class);
    }
    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

}
