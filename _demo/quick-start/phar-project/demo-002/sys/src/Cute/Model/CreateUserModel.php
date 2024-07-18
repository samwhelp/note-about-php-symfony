<?php

namespace Cute\Model;




/*

## Link

* [symfony/filesystem](https://symfony.com/doc/current/components/filesystem.html)


*/

use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;




class CreateUserModel {

	public function run ()
	{
		var_dump(__FILE__);


		$filesystem = new Filesystem();

		$path = Path::normalize(sys_get_temp_dir().'/symfony/'.random_int(0, 1000));

		echo ("\n## Create Dir: {$path} \n");

		try {
			$filesystem->mkdir(
				$path,
			);
		} catch (IOExceptionInterface $exception) {
			echo "An error occurred while creating your directory at ".$exception->getPath();
		}


	}

}
