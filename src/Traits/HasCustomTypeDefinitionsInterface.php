<?php

namespace WonderWp\Component\Taxonomy\Traits;

use WonderWp\Component\Taxonomy\Definition\TaxonomyInterface;

interface HasCustomTypeDefinitionsInterface
{
    /**
     * Provide the key of the taxonomy
     * @see TaxonomyInterface::setKey()
     * @return string
     */
    public static function provideKey(): string;

    /**
     * Provide the object types of the taxonomy
     * @see TaxonomyInterface::setObjectTypes()
     * @return array
     */
    public static function provideObjectTypes(): array;

    /**
     * Provide the args of the taxonomy
     * @see TaxonomyInterface::setArgs()
     * @return array
     */
    public static function provideArgs(): array;
}
