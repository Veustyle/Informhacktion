<?php

use Symfony\Component\Process\Process;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

$consolePath = dirname(__DIR__) . "/bin/console";


$command = [
   'php',
   $consolePath,
   'messenger:consume',
   'async',
   '--limit=0'
];
$process = new Process($command);

$process->start();