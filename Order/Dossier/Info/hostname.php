<?php
 
namespace Order\Dossier\Info;

class hostname extends \Order\Dossier\CachedInfo {
    
    protected function _retrieve()
    {
        return gethostname();
    }

}