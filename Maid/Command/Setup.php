<?php

namespace Maid\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Pull extends Command
{
    protected function configure()
    {
        $this
            ->setName('setup')
            ->setDescription('Create the needed folders for a PrestaShop project')
            ->setHelp('This command allows you to setup a PrestaShop project.
            The first param is the database server.
            The second parameter is the database user.
            The third parameter is the database password.
            The fourth parameter is the database name.');
        $this
            ->addArgument('dbServer', InputArgument::OPTIONAL, 'The database user', 'localhost')
            ->addArgument('dbUser', InputArgument::OPTIONAL, 'The database user', 'root')
            ->addArgument('dbPassword', InputArgument::OPTIONAL, 'The database password', '123')
            ->addArgument('database', InputArgument::OPTIONAL, 'The database name', 'dbLojaBase');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $path = getcwd();
            mkdir($path . '/admin/import');
            mkdir($path . '/config/xml');
            mkdir($path . '/config/xml/themes');
            mkdir($path . '/cache');
            mkdir($path . '/img');
            $settings = fopen('config/settings.inc.php', 'w');
            fwrite(
                $settings,
                '<?php\n
                   define(\'_DB_SERVER_\', \'localhost\');\n
                   define(\'_DB_NAME_\', \'dbLojaBase\');\n
                   define(\'_DB_USER_\', \'root\');\n
                   define(\'_DB_PASSWD_\', \'123\');\n
                   define(\'_DB_PREFIX_\', \'ps_\');\n
                   define(\'_MYSQL_ENGINE_\', \'InnoDB\');\n
                   define(\'_PS_CACHING_SYSTEM_\', \'CacheMemcache\');\n
                   define(\'_PS_CACHE_ENABLED_\', \'1\');\n
                   define(\'_COOKIE_KEY_\', \'4Egwv45E68Wq0MQpbFrNcLbxvUmzD38KdYZm21U99hHSdAynMVTkiEi6\');\n
                   define(\'_COOKIE_IV_\', \'Wo94HGir\');\n
                   define(\'_PS_CREATION_DATE_\', \'2015-11-04\');\n
                   if (!defined(\'_PS_VERSION_\')) {\n
                       define(\'_PS_VERSION_\', \'1.6.1.2\');\n
                   }\n
                   define(\'_RIJNDAEL_KEY_\', \'WvwoedNPb32BBEvc78N2zUdVLSGgLe7f\');\n
                   define(\'_RIJNDAEL_IV_\', \'Tx6nAfFTO8QTOSMPqtx1kQ==\');\n'
            );
            fclose($settings);
            $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(getcwd()));
            foreach ($iterator as $item) {
                    chmod($item, 777);
            }
            $output->writeln('Setup finished!');
        } catch (\Exception $e) {
            $output->writeln('Oops! Something went wrong :(');
            $output->writeln($e);
        }
    }
}
