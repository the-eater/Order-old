<?php

namespace Order\Law;

class Functions
{
    private $registred = false;

    public function register($dossier)
    {
        if ($this->registered) {
            return;
        }

        $functions = $this->getFunctions();

        foreach ($functions as $key => $value) {
            define($key, $value);
        }

        $this->registered = true;
    }

    public function getFunctions()
    {
        return [
            'which' =>  function($case, $switch, $default) {
                foreach ($switch as $key => $value) {
                    if (
                        ($key[0] == '/' && preg_match($key, $case)) ||
                        ($key == $case)
                    ) {
                        return $value;
                    }
                }

                return $default;
            }
        ];
    }
}