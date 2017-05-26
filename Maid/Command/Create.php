<?php

namespace Maid\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Create extends Command
{
    protected function configure()
    {
        $this
            ->setName('make:database')
            ->setDescription('Creates a new database')
            ->setHelp('This command allows you to create a new database.');
        $this->addArgument('database', InputArgument::REQUIRED, 'The database name')
             ->addArgument('user', InputArgument::OPTIONAL, 'The database user', 'root')
             ->addArgument('password', InputArgument::OPTIONAL, 'The database password', '123')
             ->addArgument('server', InputArgument::OPTIONAL, 'The database server', 'localhost');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $dbhost = $input->getArgument('server');
            $dbuser = $input->getArgument('user');
            $dbpass = $input->getArgument('password');
            $dbname = $input->getArgument('database');

            $connection = new \mysqli($dbhost, $dbuser, $dbpass);

            $sql = 'CREATE DATABASE "' . $dbname . '" CHARACTER SET utf8 COLLATE utf8_general_ci';

            if ($connection->query($sql)) {
                $output->writeln('Database created successfuly! Happy coding!');
            } else {
                $output->writeln($connection->error);
            }

            $connection->close();
            $output->writeln('Database created successfuly! Happy coding!');
        } catch (\Exception $e) {
            $output->writeln('Unfortunately, I was not able to finish the task. Here\'s why: ');
            $output->writeln($e);
        }
    }
}
