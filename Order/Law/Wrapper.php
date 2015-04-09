<?php


namespace Order\Law;

include_once __DIR__ . '/Functions.php';

class Wrapper {

    function __construct ($dossier) {
        $this->dossier = $dossier;
    }

    public function getPath($file)
    {
        $path = getcwd() . '/laws/' . $file;
        if (substr($file, -4) !== '.php') {
            $path .= '.php';
        }

        if (!file_exists($path)) {
            $this->error("Can\'t load $file, should have existed at $path");
            return;
        }

        return $path;
    }

    function error($message)
    {
        $bt = debug_backtrace();
        
    }

    function run($file) {
        $realFile = $this->getPath($file);
        $wrapper = $this;
        $file = realpath($realFile);

        $which = function($case, $switch, $default = null) {
            foreach ($switch as $key => $value) {
                if (
                    ($key[0] == '/' && preg_match($key, $case)) ||
                    ($key == $case)
                ) {
                    return $value;
                }
            }

            return $default;
        };

        $dossier = $this->dossier;

        $env = function ($name, $default = null) use ($dossier) {
            return $dossier->get($name, $default);
        };
        $__include_path = get_include_path();
        set_include_path('');

        include($file);
    }
}