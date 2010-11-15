<?php

/**
 * contents actions.
 *
 * @package    hinjyou
 * @subpackage contents
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class contentsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	
	$a = Doctrine::getTable('Author')->createQuery('a')->execute();
	foreach($a as $a){
		$author[$a['id']] = $a['name'];
	}
	$this->author = $author;
	
	$this->pager = new sfDoctrinePager('Hin' , 30);
	$this->pager->setQuery(HinTable::getAll());
	$this->pager->setPage($request->getParameter('page' , 1));
	$this->pager->init();
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
    /*$request->checkCSRFProtection();

    $this->forward404Unless($hin = Doctrine::getTable('Hin')->find($request->getParameter('id')), sprintf('Object hin does not exist (%s).', $request->getParameter('id')));*/

	$id = $this->getRequestParameter('id');
	$model = Doctrine::getTable('HM')->findByHin_id($id)->delete();
	$hin = Doctrine::getTable('Hin')->findOneById($id)->delete();

    $this->redirect('contents/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()));
    if ($form->isValid())
    {
      $hin = $form->save();
	  
      $this->redirect('contents/show?id='.$hin->getId());
    }
  }
  public function executeShow()
  {
  	$id = $this->getRequestParameter('id');
	
	$a = Doctrine::getTable('Hin')->findOneById($id);
	$this->hin = $a;
	
	$a = Doctrine::getTable('Author')->findOneById($a['author_id']);
	$this->author = $a['name'];
	
	$a = Doctrine::getTable('HM')->findByHin_id($id);
	$count = count($a);
	for($i = 0; $i < $count; $i++){
		$b = Doctrine::getTable('Model')->findOneById( $a[$i]['model_id'] );
		$model[] = $b['name'];
	}
	sort($model);
	$this->model = $model;

  }
  public function executeAdditem(sfWebRequest $request)
  {
    $this->form = new HinForm();
  }
  public function executeMovepage($request)
  {
	$this->forward404Unless($request->isMethod('post'));
  	$page = $request->getParameter('move');
  	$pagenate = $this->getRequestParameter('pagenate');
	$nowpage = $this->getRequestParameter('nowpage');
	
	$page = mb_convert_kana($page , 'n');// + 1;
   	if (preg_match("/^[0-9]+$/", $page) == true and $page <= $pagenate){
		$this->redirect('contents/index/?page=' . $page);
	}
	else{
		$this->redirect('contents/index/?page=' . $nowpage);
	}
  }
  public function executeXml()
  {
    $id = $this->getRequestParameter('id');
	$arguments['id'] = $id;
	chdir(sfConfig::get('sf_root_dir'));
	$task = new hinXmlTask($this->dispatcher, new sfFormatter());
    $task->run($arguments);
	
	$this->redirect('contents/show?id=' . $id);
  }
  public function executeXmlall()
  {
	$arguments['id'] = 'all';
	chdir(sfConfig::get('sf_root_dir'));
	$task = new hinXmlTask($this->dispatcher, new sfFormatter());
    $task->run($arguments);
	
	$this->redirect('contents/index');
  }
  public function executeIdmove($request)
  {
  	$id = $request->getParameter('idmove');
	$id = mb_convert_kana($id , 'n');
	$count = HinTable::getCount();
	
	if(preg_match("/^[0-9]+$/", $id) == true and $id <= $count and $id != 0){
		$this->redirect('contents/show?id=' . $id);
	}
	else{
		$now = $this->getRequestParameter('nowpage');
		$this->redirect('contents/index/?page=' . $now);
	}
  }
  
  
  
  
  //投書コンタクト
  public function executeContact(sfWebRequest $reuqest)
  {
  	$this->form = new ContactForm();
  	
  	if($data = $this->getUser()->getAttribute('contact')){
  		$this->form->setDefaults(array('username' => $data['username'],
  		'content' => $data['content']));
  	}
  }
  
  public function executeValidator(sfWebRequest $request)
  {
  	$this->forward404Unless($request->isMethod('post'));
  	$this->form = new ContactForm();
  	$this->processContact($request , $this->form);
  	$this->setTemplate('contact');
  }
  
  protected function processContact(sfWebRequest $request , sfForm $form)
  {
  	$form->bind($request->getParameter($form->getName()));
  	if($form->isValid()){
  		$this->getUser()->setAttribute('contact' , $request->getParameter($form->getName()));
  		$this->redirect('contents/confirm');
  	}
  }
  
  public function executeConfirm()
  {
  	if($this->getUser()->getAttribute('contact')){
  		$this->data = $this->getUser()->getAttribute('contact');
  	}
  }
  
  public function executeSend(sfWebRequest $request)
  {
  	$this->forward404Unless($request->isMethod('post'));
  	
  	require_once ('jcode_1.35a/jcode_wrapper.php');
  	require_once 'Zend/Mail.php';
  	
  	$mail = new Zend_Mail('ISO-2022-JP');
  	
  	$txt = jcode_convert_encoding($this->getMailTemplate($request), "ISO-2022-JP", "UTF-8");
 	$subject = jcode_convert_encoding('Hinより Contactあり', "ISO-2022-JP", "UTF-8");
  	
  	$mail->setBodyText($txt);
  	$mail->setFrom('info@HinApplication' , 'Hin');
  	$mail->addTo('suguru@iii-planning.com');
  	$mail->setSubject($subject);
  	$mail->send();
  	unset($mail);
  	$this->getUser()->getAttributeHolder()->remove('contact');
  }
  
  protected function getMailTemplate(sfWebRequest $request)
  {
  	$content = $request->getParameter('content');
  	$user = $request->getParameter('user');
  	
  	$txt = '';
  	$txt = '

名前：　' . $user . '

内容：
' . $content;
  	
  	return $txt;
  }
}
