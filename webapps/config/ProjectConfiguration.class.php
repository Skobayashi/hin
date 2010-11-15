<?php
require_once '/usr/share/pear/symfony/autoload/sfCoreAutoload.class.php';
//require_once 'C:\php\tmp\symfony-1.2.9/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    // for compatibility / remove and enable only the plugins you want
    $this->enableAllPluginsExcept(array('sfPropelPlugin', 'sfCompat10Plugin'));
	
	$tmp = '/home/iii/tmp/dom';
	sfConfig::set('hin_xml_dir', $tmp);
  }
}
