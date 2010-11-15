<?php

/**
 * Model form.
 *
 * @package    form
 * @subpackage Model
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class ModelForm extends BaseModelForm
{
  public function configure()
  {
  	$this->widgetSchema['name'] = new sfWidgetFormInput(array() , array( 'size' => 25));
	$this->validatorSchema['name'] = new sfValidatorString(array() , array('required' => '空白禁止!!'));
  }
}