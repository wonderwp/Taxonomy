<?php

namespace WonderWp\Component\Taxonomy\Traits;

trait HasCustomTypeDefinitions
{
    public function __construct()
    {
        $key = static::provideKey();
        $objectTypes = static::provideObjectTypes();
        $args = static::provideArgs();
        parent::__construct($key, $objectTypes, $args);
    }
}
