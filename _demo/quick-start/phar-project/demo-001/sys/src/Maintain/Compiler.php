<?php

namespace Maintain;




/*

## Link

* [symfony/filesystem](https://symfony.com/doc/current/components/filesystem.html)


*/

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;




class Compiler {




	function __construct ()
	{

		//$this->_ProjectRootDirPath = dirname(dirname(dirname(__DIR__)));

		$this->_ProjectRootDirPath = dirname(__DIR__, 3);


	}




	public function run ()
	{

		//ini_set('phar.readonly', 0);

		//var_dump(__FILE__);

		$project_root_dir_path = $this->_ProjectRootDirPath;

		$filesystem = new Filesystem();


		$target_phar_file_name = $this->_TargetPharFileName;

		$target_phar_file_path = "{$project_root_dir_path}/{$target_phar_file_name}";


		$project_tmp_dir_path = "{$project_root_dir_path}/tmp";

		$target_root_dir_path = "{$project_tmp_dir_path}/prj";




		if (!file_exists("{$project_root_dir_path}/lib/vendor")) {
			chdir($project_root_dir_path);
			system('composer install');
		}

		if (file_exists("{$project_tmp_dir_path}")) {
			echo "\n## Remove [tmp]({$project_tmp_dir_path})\n";
	 		$filesystem->remove("{$project_tmp_dir_path}");
		}




		foreach ([
			'app',
			'boot',
			'lib',
			'sys'
		] as $sub_path) {

			$filesystem->mirror(
				"{$project_root_dir_path}/{$sub_path}",
				"{$target_root_dir_path}/{$sub_path}"
			);

		}


		if (file_exists("{$target_phar_file_path}")) {
			$filesystem->remove("{$target_phar_file_path}");
		}


$stub = sprintf(<<<EOF
#!/usr/bin/env php
<?php
Phar::mapPhar('%s');
define('THE_PRJ_ROOT_DIR_PATH', 'phar://%s');
define('THE_BUILD_TIMESTAMP', '%s');
define('THE_APP_FILE_PATH', realpath(__FILE__));
require_once(THE_PRJ_ROOT_DIR_PATH . '/boot/start/main.php');
__HALT_COMPILER(); ?>
EOF, $target_phar_file_name, $target_phar_file_name, time());

		//echo $stub;



		$phar = new \Phar("{$target_phar_file_path}");
		$phar->setAlias($target_phar_file_name);
		$phar->setStub($stub);
		$phar->buildFromDirectory("{$target_root_dir_path}");
		$phar->compressFiles(\Phar::GZ);
		$phar->stopBuffering();


		echo "\n## Create [{$target_phar_file_name}]({$target_phar_file_path})\n";

		// Setting Phar is Executable
		chmod("{$target_phar_file_path}", 0755);

		return 0;

	}




	protected string $_ProjectRootDirPath = '';

	public function setProjectRootDirPath (string $val)
	{

		$this->_ProjectRootDirPath = $val;

		return $this;
	}




	protected string $_TargetPharFileName = 'demo.phar';

	public function setTargetPharFileName (string $val)
	{

		$this->_TargetPharFileName = $val;

		return $this;
	}




}
