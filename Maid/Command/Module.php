<?php

namespace Maid\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Module extends Command
{
    protected function configure()
    {
        $this
            ->setName('setup:module')
            ->setDescription('Create the needed folders for a PrestaShop module')
            ->setHelp('This command allows you to setup a PrestaShop module.
The first parameter is the module name. It should be CamelCased.
The second parameter is the model name');
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'The module name')
            ->addArgument('model', InputArgument::OPTIONAL, 'The model name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            try {
                $model = $input->getArgument('model');
            } catch (\Exception $e) {
                $model = null;
            }
            $name = $input->getArgument('name');
            if (isNotCamelCase($name)) {
                $name = ucfirst($name);
            }
            $path = getcwd();
            $modulePath = $path . '/' . strtolower($name);
            mkdir($modulePath);
            $mainFile = $modulePath . '/' . strtolower($name) . '.php';
            $file = fopen($mainFile, 'w');
            fwrite(
                $file,
                '<?php
if (!defined(\'_PS_VERSION_\')) {
    exit;
}
'.
    if (!is_null($model)) {
        'include_once(_PS_MODULE_DIR_.\''. strtolower($name) . '/' . $model . '.php\');'
    }
.'

class ' . $name . ' extends Module
{
    public function __construct()
    {
        $this->name = \'' . strtolower($name) . '\';
        $this->tab = \'\';
        $this->version = \'1.0\';
        $this->author = \'BettaCommerce Team\';

        parent::__construct();

        $this->displayName = \'\';
        $this->description = \'\';
        $this->ps_versions_compliancy = array(\'min\' => \'1.6.0.4\', \'max\' => \'1.6.99.99\');
    }

    public function install()
    {
        $res = true;
        $res &= parent::install();
        return $res;
    }

    public function uninstall()
    {
        $res = true;
        $res &= parent::uninstall();
        return $res;
    }

    public function getContent()
    {

    }

}
            ');
            fclose($file);

            if (!is_null($model)) {
                $modelFile = $modulePath . '/' . $model;
                $file = fopen($modelFile, 'w');
                fwrite(
                    $file,
                    '<?php
class ' . $model . ' extends ObjectModel
{
    public static $definition = [
        \'table\' => \'\',
        \'primary\' => \'\',
        \'multilang\' => \'\',
        \'fields\' => [
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function add($autodate = true, $null_values = false)
    {
        $res = parent::add($autodate, $null_values);
        return $res;
    }

    public function delete()
    {
        $res = true;
        $res &= parent::delete();
        return $res;
    }
}
'
                );
                fclose($file);
            }
            mkdir($modulePath . '/controllers');
            mkdir($modulePath . '/controllers/front');
            mkdir($modulePath . '/images');
            mkdir($modulePath . '/css');
            mkdir($modulePath . '/js');
            mkdir($modulePath . '/translations');
            mkdir($modulePath . '/views'
            mkdir($modulePath . '/views/templates');
            $output->writeln('Module setup finished! Happy coding!');
        } catch (\Exception $e) {
            $output->writeln('Unfortunately, I was not able to finish the task. Here\'s why: ');
            $output->writeln($e);
        }
    }

    private function isNotCamelCase($string)
    {
        return ctype_upper(substr($string, 0, 1));
    }
}
