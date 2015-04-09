<?php

namespace Order\Dossier;

class Papers {

    public $name;
    public $priority;
    public $path;
    public $info = [];

    function __construct($name, $priority, $path)
    {
        $this->name = $name;
        $this->priority = $priority;
        $this->path = $path;
        $this->load();
    }

    function getName()
    {
        return $this->name;
    }

    function getPriority()
    {
        return $this->priority;
    }

    function hasInfo($name)
    {
        return isset($this->info[$name]);
    }

    function getAll()
    {
        $data = [];
        $info = $this->info;
        foreach ($info as $key => $info) {
            $data[$key] = $info->retrieve();
        }

        return $data;
    }

    function getInfo($name)
    {
        if (!$this->hasInfo($name)) {
            throw new \Exception("Info with name '{$name}' for Dossier with name {$this->getName()} doesn't exist");
        }

        return $this->info[$name]->retrieve();
    }

    function load()
    {
        $files = glob($this->path.'/**.php');
        foreach ($files as $value) {
            $name = '\\Order\\Dossier\\Info\\'.ltrim(str_replace('/', '\\', substr($value, strlen($this->path), -4)), '\\');
            $baseName = basename($name);
            include_once $value;
            $this->info[$baseName] = new $name;
        }
    }

}