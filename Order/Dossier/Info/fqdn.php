<?php

namespace Order\Dossier\Info;

class fqdn extends \Order\Dossier\CachedInfo {
    
    protected function _retrieve()
    {
        if (strpos(PHP_OS, 'Win') !== -1) {
            return gethostbyaddr('127.0.0.1');
        }

        return exec('hostname -f');
    }

}