<?php

/**
 * HM form base class.
 *
 * @package    form
 * @subpackage hm
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHMForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'hin_id'   => new sfWidgetFormInputHidden(),
      'model_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'hin_id'   => new sfValidatorDoctrineChoice(array('model' => 'HM', 'column' => 'hin_id', 'required' => false)),
      'model_id' => new sfValidatorDoctrineChoice(array('model' => 'HM', 'column' => 'model_id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hm[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'HM';
  }

}
