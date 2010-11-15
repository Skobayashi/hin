<?php 
class hinXmlTask extends sfBaseTask {
    protected function configure() {
        // // add your own arguments here
        $this->addArguments(array( new sfCommandArgument('id', sfCommandArgument::REQUIRED, 'hin_id')));
        
        $this->addOptions(array( new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'), new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'), new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
            // add your own options here
            ));
            
        $this->namespace = 'hin';
        $this->name = 'xml';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [hin:xml|INFO] task does things.
Call it with:

  [php symfony hin:xml|INFO]
EOF;


}

protected function execute($arguments = array(), $options = array()) {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getDoctrineConnection();
    
    // add your code here
    try {
    	$directory = sfConfig::get('hin_xml_dir');
        $dir = opendir($directory);
        if ($dir == FALSE)
            throw new sfFileException('ERROR!!! The first argument is unjust.');
            
        if ($arguments['id'] != 'all' and preg_match("/^[0-9]+$/", $arguments['id']) != TRUE)
            throw new sfException('ERROR!!! Please put "all" or "hin_id" in the second argument.');
            
        switch ($arguments['id']) {
        
            case 'all':
                $section = scandir($directory);
                $hin = Doctrine::getTable('Hin')->findAll();
                foreach ($hin as $hin) {
                    if (!in_array($hin['id'] . '.xml' , $section)) {
                        $author = Doctrine::getTable('Author')->findOneById($hin['author_id']);
                        $hm = Doctrine::getTable('HM')->findByHin_id($hin['id']);
                        $model = array();
                        $count = count($hm);
                        for ($i = 0; $i < $count; $i++) {
                            $b = Doctrine::getTable('Model')->findOneById($hm[$i]['model_id']);
                            $model[] = $b['name'];
                        }
                        sort($model);
                        $modeler = "";
                        foreach ($model as $model) {
                            $modeler .= $model.'/';
                        }
                        $modeler = preg_replace("/\/$/", "", $modeler);
                        
                        $dom = new DOMDocument('1.0', 'UTF-8');
                        $dom->formatOutput = true;
                        
                        $hij = $dom->appendChild($dom->createElement('品質情報連絡票'));
                        $header = $hij->appendChild($dom->createElement('ヘッダー'));
                        $message = $header->appendChild($dom->createElement('メッセージ'));
                        $message->appendChild($dom->createTextNode($hin['message']));
                        $management = $header->appendChild($dom->createElement('管理票NO'));
                        $management->appendChild($dom->createTextNode($hin['id']));
                        $dispatchday = $header->appendChild($dom->createElement('発信日'));
                        $dispatchday->appendChild($dom->createTextNode(str_replace( '-' , '/' , $hin['dispatchday'])));
                        $author_id = $header->appendChild($dom->createElement('発信部所'));
                        $author_id->appendChild($dom->createTextNode($author['name']));
                        $model_id = $header->appendChild($dom->createElement('機種'));
                        $model_id->appendChild($dom->createTextNode($modeler));
                        $modelnumber = $header->appendChild($dom->createElement('機番'));
                        $modelnumber->appendChild($dom->createTextNode($hin['modelnumber']));
                        $hourmeter = $header->appendChild($dom->createElement('アワメータ'));
                        $hourmeter->appendChild($dom->createTextNode($hin['hourmeter']));
                        $delivery = $header->appendChild($dom->createElement('納入年月'));
                        $delivery->appendChild($dom->createTextNode(str_replace( '-' , '/' , $hin['delivery'])));
                        $user = $header->appendChild($dom->createElement('ユーザ名'));
                        $user->appendChild($dom->createTextNode($hin['user']));
                        $outbreak = $header->appendChild($dom->createElement('発生日'));
                        $outbreak->appendChild($dom->createTextNode(str_replace( '-' , '/' , $hin['outbreak'])));
                        $attachment = $header->appendChild($dom->createElement('作業内容アタッチメント'));
                        $attachment->appendChild($dom->createTextNode($hin['attachment']));
                        $contents = $header->appendChild($dom->createElement('内容'));
                        $contents->appendChild($dom->createTextNode($hin['contents']));
                        
                        $dom->save($directory.'/'.$hin['id'].'.xml');
                        
                    }
                }
                
                echo 'OK,allcreate.';
                
                break;
                
            default:
                try {
                    if (!Doctrine::getTable('Hin')->findOneById($arguments['id']))
                        throw new sfException('ERROR!!! There is not the ID.');
                        
                    $hin = Doctrine::getTable('Hin')->findOneById($arguments['id']);
                    $author = Doctrine::getTable('Author')->findOneById($hin['author_id']);
                    $hm = Doctrine::getTable('HM')->findByHin_id($arguments['id']);
                    $model = array();
                    $count = count($hm);
                    for ($i = 0; $i < $count; $i++) {
                        $b = Doctrine::getTable('Model')->findOneById($hm[$i]['model_id']);
                        $model[] = $b['name'];
                    }
                    sort($model);
                    $modeler = "";
                    foreach ($model as $model) {
                        $modeler .= $model.'/';
                    }
                    $modeler = preg_replace("/\/$/", "", $modeler);
                    
                    $dom = new DOMDocument('1.0', 'UTF-8');
                    $dom->formatOutput = true;
                    
                    $hij = $dom->appendChild($dom->createElement('品質情報連絡票'));
                    $header = $hij->appendChild($dom->createElement('ヘッダー'));
                    $message = $header->appendChild($dom->createElement('メッセージ'));
                    $message->appendChild($dom->createTextNode($hin['message']));
                    $management = $header->appendChild($dom->createElement('管理票NO'));
                    $management->appendChild($dom->createTextNode($hin['id']));
                    $dispatchday = $header->appendChild($dom->createElement('発信日'));
                    $dispatchday->appendChild($dom->createTextNode(str_replace( '-' , '/' , $hin['dispatchday'])));
                    $author_id = $header->appendChild($dom->createElement('発信部所'));
                    $author_id->appendChild($dom->createTextNode($author['name']));
                    $model_id = $header->appendChild($dom->createElement('機種'));
                    $model_id->appendChild($dom->createTextNode($modeler));
                    $modelnumber = $header->appendChild($dom->createElement('機番'));
                    $modelnumber->appendChild($dom->createTextNode($hin['modelnumber']));
                    $hourmeter = $header->appendChild($dom->createElement('アワメータ'));
                    $hourmeter->appendChild($dom->createTextNode($hin['hourmeter']));
                    $delivery = $header->appendChild($dom->createElement('納入年月'));
                    $delivery->appendChild($dom->createTextNode(str_replace( '-' , '/' , $hin['delivery'])));
                    $user = $header->appendChild($dom->createElement('ユーザ名'));
                    $user->appendChild($dom->createTextNode($hin['user']));
                    $outbreak = $header->appendChild($dom->createElement('発生日'));
                    $outbreak->appendChild($dom->createTextNode(str_replace( '-' , '/' , $hin['outbreak'])));
                    $attachment = $header->appendChild($dom->createElement('作業内容アタッチメント'));
                    $attachment->appendChild($dom->createTextNode($hin['attachment']));
                    $contents = $header->appendChild($dom->createElement('内容'));
                    $contents->appendChild($dom->createTextNode($hin['contents']));
                    
                    $dom->save($directory.'/'.$arguments['id'].'.xml');
                    
                    echo 'OK,create.';
					
					break;
                }
                catch(sfException $e) {
                    echo $e->getMessage();
                }
        }
    }
    catch(sfFileException $e) {
        echo $e->getMessage();
    }
    catch(sfException $e) {
        echo $e->getMessage();
    }
}
}
