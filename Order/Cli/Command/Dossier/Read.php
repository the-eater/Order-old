<?php

namespace Order\Cli\Command\Dossier;

class Read implements \Order\Cli\ICommand {

    public function execute($options)
    {
        if (!isset($options['info'])) {
            echo "Please provide info names\n";
            exit(1);
        }
        $info = $options['info'];

        $dossier = new \Order\Dossier(getcwd());
        foreach ($info as $infoName) {
            $found = false;
            foreach ($dossier->getPapers() as $paper) {
                if ($paper->hasInfo($infoName)) {
                    echo $infoName.' ('.$paper->getName($infoName).'): '.json_encode($paper->getInfo($infoName))."\n";
                    $found = true;
                }
            }

            if (!$found) {
                echo "$infoName doesn\'t exist in any dossier\n";
            }
        }
    }

    public function getOptions()
    {
        return [
            new \Order\Cli\Option('info', 'i', 'info', true)
        ];
    }

}