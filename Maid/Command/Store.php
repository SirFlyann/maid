<?php

namespace Maid\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Store extends Command
{
    protected function configure()
    {
        $this
            ->setName('setup:store')
            ->setDescription('Create the needed folders for a PrestaShop project')
            ->setHelp('This command allows you to setup a PrestaShop project.
The first param is the database name.
The second parameter is the database user.
The third parameter is the database password.
The fourth parameter is the database server.');
        $this
            ->addArgument('database', InputArgument::OPTIONAL, 'The database name', 'dbLojaBase')
            ->addArgument('dbUser', InputArgument::OPTIONAL, 'The database user', 'root')
            ->addArgument('dbPassword', InputArgument::OPTIONAL, 'The database password', '123')
            ->addArgument('dbServer', InputArgument::OPTIONAL, 'The database user', 'localhost');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $path = getcwd();
            $settings = $path . '/config/settings.inc.php';
            $file = fopen($settings, 'w');
            fwrite(
                $file,
                '<?php
define(\'_DB_SERVER_\', \''. $input->getArgument('dbServer') . '\');
define(\'_DB_NAME_\', \''. $input->getArgument('database') . '\');
define(\'_DB_USER_\', \''. $input->getArgument('dbUser') . '\');
define(\'_DB_PASSWD_\', \''. $input->getArgument('dbPassword') . '\');
define(\'_DB_PREFIX_\', \'ps_\');
define(\'_MYSQL_ENGINE_\', \'InnoDB\');
define(\'_PS_CACHING_SYSTEM_\', \'CacheMemcache\');
define(\'_PS_CACHE_ENABLED_\', \'1\');
define(\'_COOKIE_KEY_\', \'4Egwv45E68Wq0MQpbFrNcLbxvUmzD38KdYZm21U99hHSdAynMVTkiEi6\');
define(\'_COOKIE_IV_\', \'Wo94HGir\');
define(\'_PS_CREATION_DATE_\', \'2015-11-04\');
if (!defined(\'_PS_VERSION_\')) {
    define(\'_PS_VERSION_\', \'1.6.1.2\');
}
define(\'_RIJNDAEL_KEY_\', \'WvwoedNPb32BBEvc78N2zUdVLSGgLe7f\');
define(\'_RIJNDAEL_IV_\', \'Tx6nAfFTO8QTOSMPqtx1kQ==\');
'
            );
            fclose($file);
            mkdir($path . '/cache');
            mkdir($path . '/cache/sandbox');
            mkdir($path . '/log');
            mkdir($path . '/admin/import');
            mkdir($path . '/config/xml');
            mkdir($path . '/config/xml/themes');
            exec('sudo chmod 777 -R ' . $path);
            $output->writeln('Store setup finished! Happy coding!');
        } catch (\Exception $e) {
            $output->writeln('Unfortunately, I was not able to finish the task. Here\'s why: ');
            $output->writeln($e);
        }
    }
}
