<?php

namespace TastPHP\Command\HttpServerCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class StopCommand extends BaseCommand
{
    private static $argumentName = 'force';

    protected function configure()
    {
        $this
            ->setName('server:stop')
            ->setDescription('Stop the http server')
            ->addArgument(
                'force',
                InputArgument::OPTIONAL,
                'Force Stop the http server'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = [];
        $name = $input->getArgument(self::$argumentName);

        if (self::$argumentName == $name) {
            $options['force'] = true;
        }

        $httpServer = $this->getHttpServer();
        $httpServer->setOptions($options);
        $flag = $httpServer->stop();

        if (-1 == $flag) {
            $output->writeln("<fg=black;bg=red>[" . date("Y-m-d H:i:s") . "] stop http server fail.try argument force again.</>");
        }

        if (1 == $flag) {
            $output->writeln("<fg=black;bg=green>[" . date("Y-m-d H:i:s") . "] Http server Stopped.</>");
        }
    }
}