<?php

namespace PRIME\Models;

class ThemePortlet extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $html;

    /**
     *
     * @var string
     */
    public $js;

    /**
     *
     * @var string
     */
    public $css;

    /**
     *
     * @var string
     */
    public $script;

    /**
     *
     * @var string
     */
    public $style;

    /**
     *
     * @var string
     */
    public $form;

    /**
     *
     * @var integer
     */
    public $theme_layout_id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('theme_layout_id', 'ThemeLayout', 'id', array('alias' => 'ThemeLayout'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'theme_portlet';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return ThemePortlet[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return ThemePortlet
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
