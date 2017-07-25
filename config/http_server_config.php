<?php
//https://wiki.swoole.com/wiki/page/14.html
$config = [
    'host' => '0.0.0.0',
    'port' => 9502,
    'mode' => 'SWOOLE_PROCESS', //https://wiki.swoole.com/wiki/page/353.html
    'sock_type' => SWOOLE_SOCK_TCP,
];

$setting = [
    'open_cpu_affinity' => 1,
    'task_worker_num' => 4,
    'enable_port_reuse' => true,
    'worker_num' => 4,
    'log_file' => __BASEDIR__ . '/swoole.log',
    'reactor_num' => 24,
    'dispatch_mode' => 3,
    'discard_timeout_request' => true,
    'open_tcp_nodelay' => true,
    'open_mqtt_protocol' => true,
    'user' => 'www-data',
    'group' => 'www-data',
//    'daemonize' => true,
    'pid_file'=>__BASEDIR__ . '/swoole.pid',
//    'ssl_cert_file' => $key_dir . '/ssl.crt',
//    'ssl_key_file' => $key_dir . '/ssl.key',
];

return [$config,$setting];