<?php
                    namespace PRIME\Themes\Make\Portlets;
                    use PRIME\Themes\PortletBase as PortletBase;

                    class ColoredHeaderController extends PortletBase
                    {
    
                        public function initialize()
                        {
                            $this->form_struct ='[{"type":"parameters/width", "value":""},{"type":"parameters/input","name":"title","label":"Title"},{"type":"parameters/color_picker","name":"color","label":"Panel  Color"}]';
                        }
                    }