<?php
namespace PRIME\Widgets\Webarch\Charts;
use PRIME\Widgets\WidgetBase as WidgetBase;

class LineChartController extends WidgetBase
{ 
    public function initialize()
    {
        $this->icon ="fa-line-chart";
        $this->form_struct ='{"parm":
        [
        {"name":"title","label":"Title","type":"input" },
        {"name":"color_scheme","label":"Color Scheme","type":"color"}
        ],
        "db":
        {"mc_table1":
        [
        {"type":"single", "label":"X-Axis", "name":"x_axis"},
        {"type":"multiple", "label":"Series", "name":"y_series"}
        
        ]
        }
        }';
    }
    
 
}