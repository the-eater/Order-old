<?php

namespace Order\Cli;

class Option {

    protected $flag = false;
    protected $shortCode = null;
    protected $longCode = null;
    protected $multiple = false;
    protected $name = "";

    public function __construct($name, $shortCode = null, $longCode = null, $multiple = false, $flag = false)
    {
        $this->name = $name;
        $this->shortCode = $shortCode;
        $this->longCode = $longCode;
        $this->flag = !!$flag;
        $this->multiple = $multiple;
    }

    public function hasShortCode()
    {
        return $this->shortCode !== null;
    }

    public function getShortCode()
    {
        return $this->shortCode;
    }

    public function hasLongCode()
    {
        return $this->longCode !== null;
    }

    public function getLongCode()
    {
        return $this->longCode;
    }

    public function isFlag()
    {
        return $this->flag;
    }

    public function hasMultiple()
    {
        return $this->multiple;
    }

    public function getName()
    {
        return $this->name;
    }
}