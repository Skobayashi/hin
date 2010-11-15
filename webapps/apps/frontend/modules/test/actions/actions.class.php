<?php

/**
 * test actions.
 *
 * @package    hinjyou
 * @subpackage test
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class testActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    /*$this->hin_list = Doctrine::getTable('Hin')
      ->createQuery('a')
      ->execute();*/

	$a = Doctrine::getTable('Hin')->createQuery('h')
	->execute();
	
	$this->list = $a;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new HinForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new HinForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($hin = Doctrine::getTable('Hin')->find($request->getParameter('id')), sprintf('Object hin does not exist (%s).', $request->getParameter('id')));
    $this->form = new HinForm($hin);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($hin = Doctrine::getTable('Hin')->find($request->getParameter('id')), sprintf('Object hin does not exist (%s).', $request->getParameter('id')));
    $this->form = new HinForm($hin);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($hin = Doctrine::getTable('Hin')->find($request->getParameter('id')), sprintf('Object hin does not exist (%s).', $request->getParameter('id')));
    $hin->delete();

    $this->redirect('test/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $hin = $form->save();

      $this->redirect('test/edit?id='.$hin->getId());
    }
  }
}
