<?php

namespace PRIME\Models;

class Widget extends \Phalcon\Mvc\Model
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
    public $type;

    /**
     *
     * @var integer
     */
    public $column;

    /**
     *
     * @var integer
     */
    public $row;

    /**
     *
     * @var string
     */
    public $parameters;

    /**
     *
     * @var integer
     */
    public $portlet_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('portlet_id', 'Portlet', 'id', array('alias' => 'Portlet'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'widget';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Widget[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Widget
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
