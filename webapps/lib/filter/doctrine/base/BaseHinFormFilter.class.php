<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/doctrine/BaseFormFilterDoctrine.class.php');

/**
 * Hin filter form base class.
 *
 * @package    filters
 * @subpackage Hin *
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 11675 2008-09-19 15:21:38Z fabien $
 */
class BaseHinFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'author_id'   => new sfWidgetFormDoctrineChoice(array('model' => 'Author', 'add_empty' => true)),
      'dispatchday' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'modelnumber' => new sfWidgetFormFilterInput(),
      'hourmeter'   => new sfWidgetFormFilterInput(),
      'delivery'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'user'        => new sfWidgetFormFilterInput(),
      'outbreak'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'attachment'  => new sfWidgetFormFilterInput(),
      'message'     => new sfWidgetFormFilterInput(),
      'contents'    => new sfWidgetFormFilterInput(),
      'management'  => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'models_list' => new sfWidgetFormDoctrineChoiceMany(array('model' => 'Model')),
    ));

    $this->setValidators(array(
      'author_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => 'Author', 'column' => 'id')),
      'dispatchday' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'modelnumber' => new sfValidatorPass(array('required' => false)),
      'hourmeter'   => new sfValidatorPass(array('required' => false)),
      'delivery'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'user'        => new sfValidatorPass(array('required' => false)),
      'outbreak'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'attachment'  => new sfValidatorPass(array('required' => false)),
      'message'     => new sfValidatorPass(array('required' => false)),
      'contents'    => new sfValidatorPass(array('required' => false)),
      'management'  => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'models_list' => new sfValidatorDoctrineChoiceMany(array('model' => 'Model', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('hin_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addModelsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query->leftJoin('r.HM HM')
          ->andWhereIn('HM.model_id', $values);
  }

  public function getModelName()
  {
    return 'Hin';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'author_id'   => 'ForeignKey',
      'dispatchday' => 'Date',
      'modelnumber' => 'Text',
      'hourmeter'   => 'Text',
      'delivery'    => 'Date',
      'user'        => 'Text',
      'outbreak'    => 'Date',
      'attachment'  => 'Text',
      'message'     => 'Text',
      'contents'    => 'Text',
      'management'  => 'Text',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'models_list' => 'ManyKey',
    );
  }
}