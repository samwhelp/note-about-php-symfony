<?php

	require_once(THE_PRJ_ROOT_DIR_PATH . '/boot/loader/main.php');

	(new Maintain\Compiler())
		->setProjectRootDirPath(THE_PRJ_ROOT_DIR_PATH)
		->setTargetPharFileName('demo.phar')
		->run();
