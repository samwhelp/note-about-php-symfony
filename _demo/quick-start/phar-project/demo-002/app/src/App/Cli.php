<?php

namespace App;




/*

## Symfony

* [symfony/console](https://symfony.com/doc/current/components/console.html)

*/

use Symfony\Component\Console\Application;


class Cli {

	public function run () {

		$application = new Application();

		// ... register commands

		$application->run();


	}

}
