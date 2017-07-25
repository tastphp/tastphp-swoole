<?php

namespace TastPHP\Command\HttpServerCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class StartCommand extends BaseCommand
{
    private $arguments = ['d', 'daemon'];

    protected function configure()
    {
        $this
            ->setName('server:start')
            ->setDescription('Start the http server')
            ->addArgument(
                'd',
                InputArgument::OPTIONAL,
                'start the http server run as a daemon'
            )->addArgument(
                'daemon',
                InputArgument::OPTIONAL,
                'start the http server run as a daemon'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = [];
        $name = $input->getArgument('d');

        if (in_array($name, $this->arguments, true)) {
            $options['daemon'] = true;
        }

        $httpServer = $this->getHttpServer();
        $httpServer->setOptions($options);

        $outputStr = '';
        if (!empty($options['daemon']) && (true == $options['daemon'])) {
            $outputStr = 'run as a daemon';
        }

        $output->writeln("<fg=black;bg=green>[" . date("Y-m-d H:i:s") . "] Http server start {$outputStr}.</>");
        $httpServer->start();
    }
}