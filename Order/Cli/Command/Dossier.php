<?php

namespace Order\Cli\Command;

class Dossier implements \Order\Cli\ICommand {

    public function execute($options)
    {

    }

    public function getOptions()
    {
        return [
            new \Order\Cli\Option('info', 'i', 'info', false)
        ];
    }

}