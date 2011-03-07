<?php

/**
 * Hin form.
 *
 * @package    form
 * @subpackage Hin
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 6174 2007-11-27 06:22:40Z fabien $
 */
class HinForm extends BaseHinForm
{
  public function configure()
  {
  	$years2 = range(date('Y' , time()) - 5 , date('Y' , time()));
	$years = range(2000 , date('Y' , time()) + 5);
	$delivery_year = range(1990, date('Y' , time()));
  	unset($this['created_at'] , $this['updated_at'] );
  	$authorId = AuthorTable::getId();
	$modelId = ModelTable::getId();
	$authorName = AuthorTable::getItem();
	$modelName = ModelTable::getName();
	
	$this->widgetSchema['author_id'] = new sfWidgetFormChoice(array('choices' => $authorName));
	$this->widgetSchema['models_list'] = new sfWidgetFormChoice(array('choices' => $modelName , 'multiple' => TRUE));
	$this->widgetSchema['dispatchday'] = new sfWidgetFormDate(array('format' => '%year% / %month% / %day%' , 'years' => array_combine($years2 , $years2)));
	$this->widgetSchema['outbreak'] = new sfWidgetFormDate(array('format' => '%year% / %month% / %day%' , 'years' => array_combine($years2 , $years2)));
	$this->widgetSchema['delivery'] = new sfWidgetFormDate(array('format' => '%year% / %month% / %day%' , 'years' => array_combine($delivery_year , $delivery_year)));
	$this->widgetSchema['message'] = new sfWidgetFormInput(array() , array('size' => 60));
	$this->widgetSchema['contents'] = new sfWidgetFormTextarea(array() , array('cols' => 29 , "rows" => 3));
	$this->widgetSchema['management'] = new sfWidgetFormInput(array() , array('size' => 60));
	
	$this->validatorSchema['modelnumber'] = new sfValidatorString(array('max_length' => 100, 'required' => false));
	$this->validatorSchema['attachment'] = new sfValidatorString(array('max_length' => 50, 'required' => false));
	$this->validatorSchema['contents'] = new sfValidatorString(array('max_length' => 255, 'required' => false));
	$this->validatorSchema['management'] = new sfValidatorString(array('max_length' => 50, 'required' => false));
	
	$this->validatorSchema['models_list'] = new sfValidatorChoice(
	  array('choices'=> $modelId, 'multiple' => true), 
	  array('invalid'=> '必須項目です。必ず選択してください。' , 'required' => '必須項目です。'));
	
  }
}