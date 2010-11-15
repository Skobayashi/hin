<?php

/**
 * Project form base class.
 *
 * @package    form
 * @version    SVN: $Id: sfDoctrineFormBaseTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ContactForm extends BaseAuthorForm
{
  public function configure()
  {
  	unset($this['id'] , $this['name'] , $this['created_at'] , $this['updated_at']);
  	
  	$this->widgetSchema['username'] = new sfWidgetFormInput(array() , array('size' => '62'));
  	$this->widgetSchema['content'] = new sfWidgetFormTextarea();
  	
  	$this->widgetSchema['username']->setLabel('名前(必須)');
  	$this->widgetSchema['content']->setLabel('内容(必須)');
  	  	
  	$this->validatorSchema['username'] = new sfValidatorString(array() , array('required' => '必須項目!'));
  	$this->validatorSchema['content'] = new sfValidatorString(array() , array('required' => '必須項目!'));
  }
}