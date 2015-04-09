<?php

namespace Order;

class Dossier {

    private $papers = [];

    private $lawsPath;

    function __construct($path) {
        $this->register(new Dossier\Papers('own', 0, __DIR__ . '/Dossier/Info'));
        $this->register(new Dossier\Papers('sheriff', 1, $path.'/info'));
    }

    function register($papers) 
    {

        $i = 0;
        while (count($this->papers) > $i) {
            if ($papers->getPriority() > $this->papers[$i]->getPriority()) {
                break;
            }
            $i++;
        }

        array_splice($this->papers, $i, 0, [$papers]);
    }

    function get($name, $default = null)
    {
        for ($i=0; $i < count($this->papers); $i++) { 
            if ($this->papers[$i]->hasInfo($name)) {
                return $this->papers[$i]->getInfo($name);
            }
        }

        return $default;
    }

    function getPapers()
    {
        return $this->papers;
    }

    function contains($info)
    {
        $papers = $this->getPapers();
        foreach ($papers as $value) {
            if ($paper->hasInfo($info)) {
                return true;
            }
        }

        return false;
    }
}