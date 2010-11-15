<?php

/**
 * model actions.
 *
 * @package    hinjyou
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class modelActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->model_list = Doctrine::getTable('Model')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ModelForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new ModelForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($model = Doctrine::getTable('Model')->find($request->getParameter('id')), sprintf('Object model does not exist (%s).', $request->getParameter('id')));
    $this->form = new ModelForm($model);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($model = Doctrine::getTable('Model')->find($request->getParameter('id')), sprintf('Object model does not exist (%s).', $request->getParameter('id')));
    $this->form = new ModelForm($model);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($model = Doctrine::getTable('Model')->find($request->getParameter('id')), sprintf('Object model does not exist (%s).', $request->getParameter('id')));
    $model->delete();

    $this->redirect('model/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $model = $form->save();

      $this->redirect('contents/additem');
    }
  }
}
