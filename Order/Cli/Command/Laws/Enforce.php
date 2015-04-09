<?php

namespace Order\Cli\Command\Laws;

class Enforce implements \Order\Cli\ICommand {

    public function execute($options)
    {
        if (!isset($options['law'])) {
            echo "Please provide an law to enforce\n";
            exit(1);
        }
        $law = $options['law'];

        $dossier = new \Order\Dossier(getcwd());

        $wrapper = new \Order\Law\Wrapper($dossier);
        $wrapper->run($law);
    }

    public function getOptions()
    {
        return [
            new \Order\Cli\Option('dryrun', 'd', 'dryrun', false, true),
            new \Order\Cli\Option('law', 'l', 'law', false, false)
        ];
    }

}