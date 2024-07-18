<?php

namespace App;




/*

## Symfony

* [symfony/console](https://symfony.com/doc/current/components/console.html)

*/

use Symfony\Component\Console\Application;




class Cli {

	public function run ()
	{

		$application = new Application();



		// ## Register Commands

		// `./app.php app:create-user` or `demo.phar app:create-user`
		$application->add(new Command\CreateUserCommand());





		$application->run();


	}

}
