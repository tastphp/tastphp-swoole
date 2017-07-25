<?php

namespace TastPHP\Command\HttpServerCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RestartCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('server:restart')
            ->setDescription('Restart the http server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $httpServer = $this->getHttpServer();

        $httpServer->stop();
        $output->writeln("<fg=black;bg=green>[" . date("Y-m-d H:i:s") . "] Http server stopped.</>");
        sleep(1);

        $httpServer->setOptions(['daemon' => true]);

        $output->writeln("<fg=black;bg=green>[" . date("Y-m-d H:i:s") . "] Http server restart success.</>");
        $httpServer->start();
    }
}