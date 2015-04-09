<?php

namespace Order\Cli;

interface ICommand {
    public function execute($options);
    public function getOptions();
}