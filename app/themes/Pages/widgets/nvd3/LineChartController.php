<?php
namespace PRIME\Themes\Pages\Widgets\Nvd3;
use PRIME\Themes\WidgetBase as WidgetBase;

class LineChartController extends WidgetBase
{
    
    public function initialize()
    {
        $this->form_struct ='[{"type":"parameters/width"},{"type":"database/chart"}]';
        $this->data_format='Chart';


    }
}