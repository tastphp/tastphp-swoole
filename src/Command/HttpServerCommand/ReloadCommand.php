<?php

namespace TastPHP\Command\HttpServerCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class ReloadCommand extends BaseCommand
{
    private static $argumentName = 'onlyTask';

    protected function configure()
    {
        $this
            ->setName('server:reload')
            ->setDescription('Reload only task process')
            ->addArgument(
                self::$argumentName,
                InputArgument::OPTIONAL,
                'reload only task process'
            );
    }


    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $options = [];
        $name = $input->getArgument(self::$argumentName);

        if ($name == self::$argumentName) {
            $options['onlyTask'] = true;
        }

        $httpServer = $this->getHttpServer();
        $httpServer->setOptions($options);
        $httpServer->reload();

        $output->writeln("<fg=black;bg=green>[" . date("Y-m-d H:i:s") . "] Http server reload success.</>");
    }
}