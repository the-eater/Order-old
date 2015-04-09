<?php

namespace Order\Dossier;

class CachedInfo implements IInfo {

    protected $cache = false;
    protected $value;

    function retrieve()
    {
        if (!$this->cache) {
            $this->value = $this->_retrieve();
        }

        return $this->value;
    }

    protected function _retrieve()
    {
        return null;
    }
}