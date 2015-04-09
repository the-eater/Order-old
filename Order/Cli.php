<?php
namespace Order;

class Cli {

    private $loaded = false;
    private $commands = [];

    function execute($name, $action, $args)
    {

        $fullName = $name.($action !== null ? '/' . $action : '');
        
        if (!isset($this->commands[$fullName])) {
            throw new \Exception("Command {$fullName} not found");
        }

        $command = $this->commands[$fullName];
        $options = $command->getOptions();
        
        $command->execute($this->parseOptions($options, $args));
    }

    function parseOptions($options, $args)
    {
        $codeMap    = [];
        $shortCodes = [];
        $longCodes  = [];
        foreach ($options as $key => $option) {
            if ($option->hasShortCode()) {
                $shortCode = $option->getShortCode();
                $codeMap[$shortCode] = $option;
            }

            if ($option->hasLongCode()) {
                $longCode = $option->getLongCode();
                $codeMap[$longCode] = $option;
            }
        }

        $result = [];
        for ($i = 0; $i < count($args); $i++) { 
            $arg = $args[$i];
            if ($arg == '--') break;
            if ($arg[0] == '-' && $arg[1] == '-') {
                $name = substr($arg, 2);
                if ($name == $option->getLongCode()) {
                    $argName = $option->getName();
                    if ($option->isFlag()) {
                        $result[$argName] = false;
                    } else if ($option->hasMultiple()) {
                        if (isset($result[$argName])) {
                            $result[$argName] = [];
                        }
                        $result[$argName][] = $args[++$i];
                    } else {
                        if (!isset($result[$argName])) {
                            $result[$argName] = $args[++$i];
                        }
                    }
                }
            } else if ($arg[0] == '-') {
                $names = substr($arg, 1);
            }
        }

        return $result;
    }

    function load()
    {
        if ($this->loaded) return;

        $cliCommands = glob(__DIR__ . '/Cli/Command/*/*.php');
        foreach ($cliCommands as $command) {
            $basename = basename($command);
            $parent = basename(dirname($command));
            $className = substr($basename, 0, strlen($basename) - 4);
            $fullClassName = '\\Order\\Cli\\Command\\'.$className;
            include_once($command);
            if ($parent !== 'Command') {
                $fullClassName = '\\Order\\Cli\\Command\\'.$parent.'\\'.$className;
                $className = $parent . "/" . substr($basename, 0, strlen($basename) - 4);
            }
            $this->commands[strtolower($className)] = new $fullClassName;
        }

        $this->loaded = true;
    }

    function getCommands()
    {
        return $this->commands;
    }
}