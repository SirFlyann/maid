<?php

namespace Maid\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DBSetup extends Command
{
    protected function configure()
    {
        $this
            ->setName('setup:database')
            ->setDescription('Creates a database and feed it with an sql file')
            ->setHelp('This command allows you to create a new database and execute an sql dump on it.');
        $this->addArgument('dump', InputArgument::REQUIRED, 'The path to the dump')
             ->addArgument('database', InputArgument::REQUIRED, 'The database name')
             ->addArgument('user', InputArgument::OPTIONAL, 'The database user', 'root')
             ->addArgument('password', InputArgument::OPTIONAL, 'The database password', '123')
             ->addArgument('server', InputArgument::OPTIONAL, 'The database server', 'localhost');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $create = $this->getApplication()->find('make:database');
            $dump = $this->getApplication()->find('run:dump');

            $file = $input->getArgument('dump');
            $dbhost = $input->getArgument('server');
            $dbuser = $input->getArgument('user');
            $dbpass = $input->getArgument('password');
            $dbname = $input->getArgument('database');

            $createInput = new ArrayInput([
                'command' => 'make:database',
                'database' => $dbname,
                'user' => $dbuser,
                'password' => $dbpass,
                'server' => $dbhost
            ]);

            $create->run($createInput, $output);

            $dumpInput = new ArrayInput([
                'command' => 'run:dump',
                'dump' => $file,
                'database' => $dbname,
                'user' => $dbuser,
                'password' => $dbpass,
                'server' => $dbhost
            ]);

            $dump->run($dumpInput, $output);

            $output->writeln('Database set up successfuly! Happy coding!');
        } catch (\Exception $e) {
            $output->writeln('Unfortunately, I was not able to finish the task. Here\'s why: ');
            $output->writeln($e);
        }
    }
}
