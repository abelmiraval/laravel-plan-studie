<?php
namespace App\Custom;
use Illuminate\Database\Eloquent\Model;

class PlanViewModel
{
    public $level;
    public $code;
    public $name;
    public $theoretical_hours;
    public $practical_hours;
    public $credits;
    public $requeriments;

    public function __construct($level, $code, $name, $theoreticalHours, $practicalHours, $credits, $requeriments){
        $this->level = $level;
        $this->code = $code;
        $this->name = $name;
        $this->theoretical_hours = $theoreticalHours;
        $this->practical_hours = $practicalHours;
        $this->credits = $credits;
        $this->requeriments = $requeriments;
    }

}
