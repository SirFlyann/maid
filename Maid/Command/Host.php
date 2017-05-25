<?php

namespace Maid\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Host extends Command
{
    protected function configure()
    {
        $this
            ->setName('setup:vhost')
            ->setDescription('Create a virtual host')
            ->setHelp('This command allows you to create a virtual host.
The first parameter is the name of the virtual host.
The second parameter is the path to the project\'s root.
The third parameter is to set a custom path to your virtual host
Use the --local option to set the .dev domain to it.
Use the --domain option to define your own domain.');
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The name of the virtual host')
            ->addArgument('root', InputArgument::OPTIONAL, 'The document root of your project', '/var/www/html/')
            ->addArgument('vhost', InputArgument::OPTIONAL, 'The path where virtual hosts are put in your machine', '/etc/apache2/sites-available/')
            ->addOption('local', 'l', InputOption::VALUE_NONE, 'Is it for local development ?')
            ->addOption('domain', 'd', InputOption::VALUE_REQUIRED, 'Is it for another domain ?');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $path = $input->getArgument('vhost');
            $name = $input->getArgument('name');
            $root = $input->getArgument('root');
            if ($input->getOption('local')) {
                $host = '.dev';
            } elseif ($input->getOption('domain')) {
                if (substr($input->getOption('domain'), 0, 1) == '.') {
                    $host = $input->getOption('domain');
                } else {
                    $host = '.' . $input->getOption('domain');
                }
            } else {
                $host = '.dev';
            }

            if (substr($root, -1) == '/') {
                $docRoot = $root .  $name;
            } else {
                $docRoot = $root . '/' .  $name;
            }
            $site = $name . $host;

            if (substr($path, -1) == '/') {
                $conf = $path .  $name . '.conf';
            } else {
                $conf = $path . '/' .  $name . '.conf';
            }
            $file = fopen($conf, 'w');
            fwrite(
                $file,
                '
<VirtualHost *:80>
    ServerAdmin webmaster@localhost
    ServerName ' . $site . '
    ServerAlias ' . $site . '
    DocumentRoot ' . $docRoot . '
    ErrorLog ${APACHE_LOG_DIR}/' . $name . '_error.log
    CustomLog ${APACHE_LOG_DIR}/' . $name . '_access.log combined
</VirtualHost>
'
            );
            fclose($file);

            $file = fopen('/etc/hosts', 'a');
            fwrite($file, '

127.0.0.1 '. $site . '

    ');
            fclose($file);
            exec('sudo a2ensite ' . $name . '.conf');
            exec('sudo service apache2 restart');
            $output->writeln('The virtual host has been set successfully! Happy coding!');
        } catch (\Exception $e) {
            $output->writeln('Unfortunately, I was not able to finish the task. Here\'s why: ');
            $output->writeln($e);
        }
    }
}
