<?php

namespace WonderWp\Component\Taxonomy\Traits;

interface HasCustomTypeDefinitionsInterface
{
    public static function provideKey(): string;
    public static function provideArgs(): array;
}
