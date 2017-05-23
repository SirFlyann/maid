<?php

namespace Maid\Command;

use Cz\Git\GitRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Pull extends Command
{
    protected function configure()
    {
        $this
            ->setName('pull')
            ->setDescription('Pulls the base repository from BitBucket')
            ->setHelp('This command allows you to pull a base repository from BitBucket. The first parameter is the repository url. The second parameter is the path where the repository will be cloned. The third parameter is the new remote location.');
        $this
            ->addArgument('url', InputArgument::REQUIRED, 'The url of the repository')
            ->addArgument('folder', InputArgument::OPTIONAL, 'The folder to place the repository in')
            ->addArgument('newRemote', InputArgument::OPTIONAL, 'The new remote location');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $url = $input->getArgument('url');
            try {
                $folder = $input->getArgument('folder');
            } catch (\Exception $e) {
                $folder = null;
            }

            $repo = GitRepository::cloneRepository($url, $folder);

            try {
                $remote = $input->getArgument('newRemote');
            } catch (\Exception $e) {
                $remote = null;
            }

            if (!is_null($remote)) {
                $repo->removeRemote('origin');
                $repo->addRemote('origin', $remote);
            }
            $output->writeln('Repository cloned successfully!');
        } catch (\Exception $e) {
            $output->writeln('Oops! Something went wrong :(');
            $output->writeln($e);
        }
    }
}
