<?php

namespace App;


class Cli {

	public function run () {

		(new \Cute\Model\DemoModel())
			->run();

	}

}
