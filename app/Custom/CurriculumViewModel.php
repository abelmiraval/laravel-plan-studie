<?php
namespace App\Custom;


class CurriculumViewModel
{
    public $area;
    public $code;
    public $name;
    public $content;
    public $main_objective;
    public $secondary_objective;

    public function __construct($area, $code, $name, $content, $main_objective, $secondary_objective){
        $this->area = $area;
        $this->code = $code;
        $this->name = $name;
        $this->content = $content;
        $this->main_objective = $main_objective;
        $this->secondary_objective = $secondary_objective;
    }

}
