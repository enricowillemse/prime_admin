<?php
namespace PRIME\Themes\Make\Widgets\Charts;
use PRIME\Themes\WidgetBase as WidgetBase;

class PieChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"database/single_select","name":"label","label":"Label"},{"type":"parameters/color_select","name":"colors","label":"Colors"},{"type":"database/link_select"},{"type":"parameters/input","name":"chart_title","label":"Title"},{"type":"database/single_select","name":"value","label":"Value"}]';
        $this->data_format='ByRow';


    }
}