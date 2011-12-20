<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Deploys a project to another server.
 *
 * @package    symfony
 * @subpackage task
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfProjectDeployTask.class.php 23922 2009-11-14 14:58:38Z fabien $
 */
class hinDeployTask extends sfProjectDeployTask
{
  protected
    $outputBuffer = '',
    $errorBuffer = '';

  /**
   * @see sfTask
   */
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('server', sfCommandArgument::REQUIRED, 'The server name'),
    ));

    $this->addOptions(array(
      new sfCommandOption('go', null, sfCommandOption::PARAMETER_NONE, 'Do the deployment'),
      new sfCommandOption('rsync-dir', null, sfCommandOption::PARAMETER_REQUIRED, 'The directory where to look for rsync*.txt files', 'config'),
      new sfCommandOption('rsync-options', null, sfCommandOption::PARAMETER_OPTIONAL, 'To options to pass to the rsync executable', '-azC --force --delete --progress'),
    ));

    $this->namespace = 'hin';
    $this->name = 'deploy';
    $this->briefDescription = 'Deploys a project to another server';

    $this->detailedDescription = <<<EOF
The [project:deploy|INFO] task deploys a project on a server:

  [./symfony project:deploy production|INFO]

The server must be configured in [config/properties.ini|COMMENT]:

  [[production]
    host=www.example.com
    port=22
    user=fabien
    dir=/var/www/sfblog/
    type=rsync|INFO]

To automate the deployment, the task uses rsync over SSH.
You must configure SSH access with a key or configure the password
in [config/properties.ini|COMMENT].

By default, the task is in dry-mode. To do a real deployment, you
must pass the [--go|COMMENT] option:

  [./symfony project:deploy --go production|INFO]

Files and directories configured in [config/rsync_exclude.txt|COMMENT] are
not deployed:

  [.svn
  /web/uploads/*
  /cache/*
  /log/*|INFO]

You can also create a [rsync.txt|COMMENT] and [rsync_include.txt|COMMENT] files.

If you need to customize the [rsync*.txt|COMMENT] files based on the server,
you can pass a [rsync-dir|COMMENT] option:

  [./symfony project:deploy --go --rsync-dir=config/production production|INFO]

Last, you can specify the options passed to the rsync executable, using the
[rsync-options|INFO] option (defaults are [-azC --force --delete --progress|INFO]):

  [./symfony project:deploy --go --rsync-options=-avz|INFO]
EOF;
  }

  /**
   * @see sfTask
   */
  protected function execute($arguments = array(), $options = array())
  {
    $env = $arguments['server'];

    $ini = sfConfig::get('sf_config_dir').'/properties.ini';
    if (!file_exists($ini))
    {
      throw new sfCommandException('You must create a config/properties.ini file');
    }

    $properties = parse_ini_file($ini, true);

    if (!isset($properties[$env]))
    {
      throw new sfCommandException(sprintf('You must define the configuration for server "%s" in config/properties.ini', $env));
    }

    $properties = $properties[$env];

    if (!isset($properties['host']))
    {
      throw new sfCommandException('You must define a "host" entry.');
    }

    if (!isset($properties['dir']))
    {
      throw new sfCommandException('You must define a "dir" entry.');
    }

    $host = $properties['host'];
    $dir  = $properties['dir'];
    $user = isset($properties['user']) ? $properties['user'].'@' : '';

    if (substr($dir, -1) != '/')
    {
      $dir .= '/';
    }

    $ssh = 'ssh';

    if (isset($properties['port']))
    {
        if (isset($properties['key']))
	    {
			$instance_dir = dirname(__FILE__);
			$instance_dir = explode(DIRECTORY_SEPARATOR, $instance_dir);
			$user_dir = $instance_dir[count($instance_dir)-6];
			$key = sprintf($properties['key'], $user_dir);
	    }
	    else
	    {
	      throw new sfCommandException('You must configurate a parameters');
	    }
      $port = $properties['port'];
      $ssh = '"ssh -p'.$port.' '.$key.'"';
    }

    if (isset($properties['parameters']))
    {
      $parameters = $properties['parameters'];
    }
    else
    {
      throw new sfCommandException('You must configurate a parameters');
    }
    
    $dryRun = $options['go'] ? '' : '--dry-run';
    $command = "rsync $dryRun $parameters -e $ssh ./ $user$host:$dir";

    //exec($command);
    //$this->getFilesystem()->execute($command, true ? array($this, 'logOutput') : null, array($this, 'logErrors'));

    $descriptorspec = array(
      1 => array('pipe', 'w'), // stdout
      2 => array('pipe', 'w'), // stderr
    );

    $process = proc_open($command, $descriptorspec, $pipes);

    if(! is_resource($process)) {
        throw new Exception('コマンドが実行できません');
    }

    stream_set_blocking($pipes[1], false);
    stream_set_blocking($pipes[2], false);

    $output = '';
    $err = '';
    $buffer = '';

    while (!feof($pipes[1]) || !feof($pipes[2])) {
        foreach($pipes as $k => $pipe) {
            if(! $line = fread($pipe, 128)) {
                continue;
            }

            if($k == 1) {
                $output .= $line;

                if(false !== $pos = strpos($line, "\n")) {
                    $buffer .= substr($line, 0, $pos);
                    echo "$buffer \n";
                    $buffer = substr($line, $pos + 1);
                } else {
                    $buffer .= $line;
                }
            } else {
                $err .= $line;

                if(false !== $pos = strpos($line, "\n")) {
                    $buffer .= substr($line, 0, $pos);
                    echo "error: $buffer \n";
                    $buffer = substr($line, $pos + 1);
                } else {
                    $buffer .= $line;
                }
            }
        }
        usleep(100000);
    }

    $this->clearBuffers();
  }

  public function logOutput($output)
  {
    if (false !== $pos = strpos($output, "\n"))
    {
      $this->outputBuffer .= substr($output, 0, $pos);
      $this->log($this->outputBuffer);
      $this->outputBuffer = substr($output, $pos + 1);
    }
    else
    {
      $this->outputBuffer .= $output;
    }
  }

  public function logErrors($output)
  {
    if (false !== $pos = strpos($output, "\n"))
    {
      $this->errorBuffer .= substr($output, 0, $pos);
      $this->log($this->formatter->format($this->errorBuffer, 'ERROR'));
      $this->errorBuffer = substr($output, $pos + 1);
    }
    else
    {
      $this->errorBuffer .= $output;
    }
  }

  protected function clearBuffers()
  {
    if ($this->outputBuffer)
    {
      $this->log($this->outputBuffer);
      $this->outputBuffer = '';
    }

    if ($this->errorBuffer)
    {
      $this->log($this->formatter->format($this->errorBuffer, 'ERROR'));
      $this->errorBuffer = '';
    }
  }
}
