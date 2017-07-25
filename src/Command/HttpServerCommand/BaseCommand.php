<?php

namespace TastPHP\Command\HttpServerCommand;

use Symfony\Component\Console\Command\Command;
use TastPHP\App\HttpServerKernel;

class BaseCommand extends Command
{
    protected function getHttpServer()
    {
        return HttpServerKernel::getInstance();
    }
}