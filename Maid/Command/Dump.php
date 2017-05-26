<?php

namespace Maid\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Dump extends Command
{
    protected function configure()
    {
        $this
            ->setName('run:dump')
            ->setDescription('Executes a dump file on a given database')
            ->setHelp('This command allows you to execute an sql dump on a database.');
        $this->addArgument('dump', InputArgument::REQUIRED, 'The path to the dump')
             ->addArgument('database', InputArgument::REQUIRED, 'The database name')
             ->addArgument('user', InputArgument::OPTIONAL, 'The database user', 'root')
             ->addArgument('password', InputArgument::OPTIONAL, 'The database password', '123')
             ->addArgument('server', InputArgument::OPTIONAL, 'The database server', 'localhost');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $dump = $input->getArgument('dump');
            $dbhost = $input->getArgument('server');
            $dbuser = $input->getArgument('user');
            $dbpass = $input->getArgument('password');
            $dbname = $input->getArgument('database');

            $command = 'mysql --host=' . $dbhost . ' --user=' . $dbuser . ' --password=' . $dbpass . ' --database=' . $dbname . ' --execute="SOURCE "' . $dump;
            exec($command);

            $output->writeln('Database dumped successfuly! Happy coding!');
        } catch (\Exception $e) {
            $output->writeln('Unfortunately, I was not able to finish the task. Here\'s why: ');
            $output->writeln($e);
        }
    }
}
