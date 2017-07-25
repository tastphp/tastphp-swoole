<?php

namespace TastPHP\App;

use TastPHP\Framework\Http\Request;

class HttpServerKernel implements ServerKernel
{
    protected $app;
    protected $httpServer;
    protected $options;
    private static $instance;

    function __construct()
    {
        date_default_timezone_set(TIMEZONE);
        self::$instance = $this;
    }

    public function setOptions($options)
    {
        $this->options = $options;
    }

    public static function getInstance()
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function init()
    {
        list($config, $setting) = require __BASEDIR__ . "/config/http_server_config.php";
        $this->httpServer = new \swoole_http_server($config['host'], $config['port']);

        if (!empty($this->options) && (true == $this->options['daemon'])) {
            $setting['daemonize'] = true;
        }

        $this->httpServer->set($setting);

        $this->httpServer->on('request', [$this, 'noRequest']);

        $this->httpServer->on('finish', [$this, 'onTaskFinish']);

        $this->httpServer->on('task', [$this, 'onTask']);

        $this->httpServer->on('workerStart', [$this, 'onWorkerStart']);
    }

    public function start()
    {
        $this->init();
        $this->httpServer->start();
    }

    public function reload()
    {
        $pidFile = __BASEDIR__ . '/swoole.pid';

        $sig = SIGUSR1;

        if (!empty($this->options['onlyTask']) && $this->options['onlyTask'] = true) {
            $sig = SIGUSR2;
        }

        if (!file_exists($pidFile)) {
            echo "pid file :{$pidFile} not exist \n";
            return;
        }

        $pid = file_get_contents($pidFile);

        if (!\swoole_process::kill($pid, 0)) {
            echo "pid :{$pid} not exist \n";
            return -1;
        }

        \swoole_process::kill($pid, $sig);

        return 1;
    }

    public function stop()
    {
        $pidFile = __BASEDIR__ . '/swoole.pid';
        $pid = file_get_contents($pidFile);

        if (!\swoole_process::kill($pid, 0)) {
            echo "pid :{$pid} not exist \n";
            return;
        }

        if (!empty($this->options['force'])) {
            \swoole_process::kill($pid, SIGKILL);
        } else {
            \swoole_process::kill($pid);
        }

        $time = time();
        while (true) {
            usleep(1000);
            if (\swoole_process::kill($pid, 0)) {
                unlink($pidFile);
                return 1;
                break;
            } else {
                if (time() - $time > 2) {
                    return -1;
                    break;
                }
            }
        }
    }

    function onWorkerStart($serv, $worker_id)
    {
        $this->app = new AppKernel();
    }


    function noRequest(\swoole_http_request $request, \swoole_http_response $response)
    {
        if ('/favicon.ico' == $request->server['request_uri']) {
            $response->end();
            return;
        }

        $_GET = $request->get ?? [];
        $_POST = $request->post ?? [];
        $_COOKIE = $request->cookie ?? [];
        $_FILES = $request->files ?? [];
        $content = $request->rawContent() ?: null;
        $appRequest = new Request(
            $_GET,
            $_POST,
            [],
            $_COOKIE,
            $_FILES,
            $_SERVER,
            $content
        );

        $this->app['Request'] = $this->app['symfonyRequest'] = $appRequest;
        $appResponse = $this->app->run()->getResponse();
        $response->write($appResponse);
        $response->end();

        unset($appRequest);
        unset($appResponse);
    }

    function terminate()
    {

    }

    function onTaskFinish()
    {

    }

    function onTask()
    {

    }
}