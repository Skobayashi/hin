<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class BaseHin extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('hin');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('author_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));
        $this->hasColumn('dispatchday', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('modelnumber', 'string', 100, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('hourmeter', 'string', 100, array(
             'type' => 'string',
             'length' => '100',
             ));
        $this->hasColumn('delivery', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('user', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('outbreak', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('attachment', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('message', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
        $this->hasColumn('contents', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('management', 'string', 50, array(
             'type' => 'string',
             'length' => '50',
             ));
    }

    public function setUp()
    {
        parent::setUp();
    $this->hasOne('Author', array(
             'local' => 'author_id',
             'foreign' => 'id'));

        $this->hasMany('Model as Models', array(
             'refClass' => 'HM',
             'local' => 'hin_id',
             'foreign' => 'model_id'));

        $this->hasMany('HM as HMs', array(
             'local' => 'id',
             'foreign' => 'hin_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}