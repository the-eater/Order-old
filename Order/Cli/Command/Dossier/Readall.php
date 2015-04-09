<?php

namespace Order\Cli\Command\Dossier;

class Readall implements \Order\Cli\ICommand {

    public function execute($options)
    {
        $result = [];
        $allowedPapers = isset($options['papers']) ? $options['papers'] : null;
        $dossier = new \Order\Dossier(getcwd());
        $papers = $dossier->getPapers();
        foreach ($papers as $key => $paper) {
            $paperName = $paper->getName();
            if ($allowedPapers === null || in_array($paperName, $allowedPapers)) {
                $result[$paperName . '#' . $key] = $paper->getAll();
            }
        }

        var_dump($result);
    }

    public function getOptions()
    {
        return [
            new \Order\Cli\Option('papers', 'p', 'paper', true)
        ];
    }

}