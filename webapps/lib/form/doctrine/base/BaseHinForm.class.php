<?php

/**
 * Hin form base class.
 *
 * @package    form
 * @subpackage hin
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 8508 2008-04-17 17:39:15Z fabien $
 */
class BaseHinForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'author_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'Author', 'add_empty' => true)),
      'dispatchday' => new sfWidgetFormDate(),
      'modelnumber' => new sfWidgetFormInput(),
      'hourmeter'   => new sfWidgetFormInput(),
      'delivery'    => new sfWidgetFormDate(),
      'user'        => new sfWidgetFormInput(),
      'outbreak'    => new sfWidgetFormDate(),
      'attachment'  => new sfWidgetFormInput(),
      'message'     => new sfWidgetFormInput(),
      'contents'    => new sfWidgetFormInput(),
      'management'  => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'models_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Model')),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorDoctrineChoice(array('model' => 'Hin', 'column' => 'id', 'required' => false)),
      'author_id'   => new sfValidatorDoctrineChoice(array('model' => 'Author', 'required' => false)),
      'dispatchday' => new sfValidatorDate(array('required' => false)),
      'modelnumber' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'hourmeter'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'delivery'    => new sfValidatorDate(array('required' => false)),
      'user'        => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'outbreak'    => new sfValidatorDate(array('required' => false)),
      'attachment'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'message'     => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'contents'    => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'management'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'models_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Model', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hin[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Hin';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['models_list']))
    {
      $this->setDefault('models_list', $this->object->Models->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveModelsList($con);
  }

  public function saveModelsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['models_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Models->getPrimaryKeys();
    $values = $this->getValue('models_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Models', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Models', array_values($link));
    }
  }

}
