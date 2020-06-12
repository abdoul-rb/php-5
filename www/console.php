<?php

use App\Core\Command\Receiver;
use App\Core\Command\Invoker;
use App\Core\ConstantLoader;

include 'Core/Autoloader.php';

new ConstantLoader();

$firstArg = array_shift($argv);

if('console' !== $firstArg)
{
    $out = fopen('php://output', 'w'); //output handler
    fputs($out, "Not a command.\n"); //writing output operation
    fclose($out); //closing handler
}

$commandArg = array_shift($argv);

$commandeName = "App\Command\\".$commandArg."Command";

$receiver = new Receiver();
$invoker = new Invoker();
$command = new $commandeName($receiver);
$command->setArgs($argv);
$invoker->setCommand($command);

$invoker->run();