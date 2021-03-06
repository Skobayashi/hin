<?php
require_once dirname(__FILE__). '/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
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
