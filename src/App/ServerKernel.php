<?php

namespace TastPHP\App;

interface ServerKernel
{
    public function init();

    public function start();

    public function reload();

    public function stop();

    public function terminate();
}