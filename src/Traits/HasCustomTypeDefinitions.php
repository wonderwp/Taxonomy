<?php

namespace WonderWp\Component\Taxonomy\Traits;

trait HasCustomTypeDefinitions
{
    public function __construct()
    {
        $key = static::provideKey();
        $args = static::provideArgs();
        parent::__construct($key, $args);
    }
}
