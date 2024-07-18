<?php

namespace App\Command;

/*

## Symfony / Docs

* Console Commands / [Creating a Command](https://symfony.com/doc/current/console.html#creating-a-command)

*/

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;


// the name of the command is what users type after "php bin/console"
#[AsCommand(name: 'app:create-user')]
class CreateUserCommand extends Command {




	protected function execute (InputInterface $input, OutputInterface $output): int
	{
		// ... put here the code to create the user


		(new \Cute\Model\CreateUserModel())
			->setUserName($input->getArgument('username'))
			->setUserTitle($input->getOption('user-title'))
			->setUserRole($input->getOption('user-role'))
			->run();


		$output->writeln('');

		$output->writeln([
			'User Creator',
			'============',
			'',
		]);

		// retrieve the argument value using getArgument()
		$output->writeln('Username: '.$input->getArgument('username'));



		// this method must return an integer number with the "exit status code"
		// of the command. You can also use these constants to make code more readable

		// return this if there was no problem running the command
		// (it's equivalent to returning int(0))
		return Command::SUCCESS;

		// or return this if some error happened during the execution
		// (it's equivalent to returning int(1))
		// return Command::FAILURE;

		// or return this to indicate incorrect command usage; e.g. invalid options
		// or missing arguments (it's equivalent to returning int(2))
		// return Command::INVALID
	}




	protected function configure (): void
	{

		// run `demo.phar help app:create-user`
		$this
			// the command description shown when running "php bin/console list"
			->setDescription('Creates a new user.')
			// the command help shown when running the command with the "--help" option
			->setHelp('This command allows you to create a user...')
		;


		// ## https://symfony.com/doc/current/console/input.html#using-command-arguments
		$this->addArgument(
			'username',
			InputArgument::REQUIRED,
			'The user name of the user.'
		);


		// ## https://symfony.com/doc/current/console/input.html#using-command-options
		$this->addOption(
			'user-title',
			null,
			InputOption::VALUE_OPTIONAL,
			'The user title of the user.',
			''
		);


		$this->addOption(
			'user-role',
			'r',
			InputOption::VALUE_OPTIONAL,
			'The user role of the user.',
			'Normal'
		);



	}




}
