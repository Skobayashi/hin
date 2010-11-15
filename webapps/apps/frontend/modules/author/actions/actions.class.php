<?php

/**
 * author actions.
 *
 * @package    hinjyou
 * @subpackage author
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class authorActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->author_list = Doctrine::getTable('Author')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new AuthorForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post'));

    $this->form = new AuthorForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
	
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($author = Doctrine::getTable('Author')->find($request->getParameter('id')), sprintf('Object author does not exist (%s).', $request->getParameter('id')));
    $this->form = new AuthorForm($author);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod('post') || $request->isMethod('put'));
    $this->forward404Unless($author = Doctrine::getTable('Author')->find($request->getParameter('id')), sprintf('Object author does not exist (%s).', $request->getParameter('id')));
    $this->form = new AuthorForm($author);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($author = Doctrine::getTable('Author')->find($request->getParameter('id')), sprintf('Object author does not exist (%s).', $request->getParameter('id')));
    $author->delete();

    $this->redirect('author/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $author = $form->save();

      $this->redirect('contents/additem');
    }
  }
}
