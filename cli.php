#!/bin/env php
<?php

include 'main.php';

if (!isset($argv[1])) {
    echo("No command given, please order me\n");
    exit(1);
}

$command = $argv[1];
$action  = isset($argv[2]) ? $argv[2] : null;
$args = array_slice($argv, 3);
if ($action[0] == '-') {
    $action = null;
    $args = array_slice($argv, 2);
}
$cli = new \Order\Cli();
$cli->load();
$cli->execute($command, $action, $args);