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

		//var_dump(__FILE__);

		$code_file = __FILE__;
		echo("\n## Code File: {$code_file} \n");


		$user_name = $this->_UserName;
		echo("\n## User Name Input: {$user_name} \n");

		$user_title = $this->_UserTitle;
		echo("\n## User Title Input: {$user_title} \n");


		$filesystem = new Filesystem();
		$user_db_dir_path = Path::normalize(sys_get_temp_dir() . '/symfony/demo-project/db/user');
		$filesystem->mkdir($user_db_dir_path,);
		echo("\n## Create Dir: {$user_db_dir_path} \n");


		//https://www.php.net/manual/en/function.file-put-contents.php

		$user_db_file_path = $user_db_dir_path . '/' . $user_name;
		$user_db_content = '';
		$user_db_content .= "UserName: {$user_name}\n";
		$user_db_content .= "UserTitle: {$user_title}\n";
		file_put_contents($user_db_file_path, $user_db_content);
		echo("\n## Create User : [{$user_name}]({$user_db_file_path}) \n");
		echo("\n> $ `cat {$user_db_file_path}` \n");


	}




	protected string $_UserName = '';

	public function setUserName (string $val)
	{

		$this->_UserName = $val;

		return $this;
	}




	protected string $_UserTitle = '';

	public function setUserTitle (string $val)
	{

		$this->_UserTitle = $val;

		return $this;
	}




}
