<?php

$consolePath = "../bin/console";


$command = [
   'php',
   $consolePath,
   'messenger:consume',
   'async',
   '--limit=0'
];

$process = new Symfony\Component\Process($command);
$process->start();