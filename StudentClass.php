<?php

class StudentClass extends ObjectModel
{
    public $name;

    public $bdate;

    public $status;

    public $avgscore;

    public static $definition = array(
        'table' => 'student',
        'primary' => 'id_student',
        'multilang' => true,
        'fields' => array(
            'name' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'lang' => TRUE),
            'bdate' => array('type' => self::TYPE_DATE),
            'status' => array('type' => self::TYPE_BOOL),
            'avgscore' => array ('type' => self::TYPE_FLOAT)
        ),
      );


    public function getAll()
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . self::$definition['table'] . '`';
        return Db::getInstance()->executeS($sql);
    }

    public function getTopStudent()
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . self::$definition['table'] . '` 
        WHERE avgscore = (SELECT MAX(avgscore) FROM `' . _DB_PREFIX_ . self::$definition['table'] . '`)';
        return Db::getInstance()->getValue($sql);
    }

    public function getTopAvgScore()
    {
        $sql = 'SELECT MAX(avgscore) FROM `' . _DB_PREFIX_ . self::$definition['table'] . '` ';
        return Db::getInstance()->getValue($sql);
    }

}