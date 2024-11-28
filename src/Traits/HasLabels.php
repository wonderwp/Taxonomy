<?php

namespace WonderWp\Component\Taxonomy\Traits;

trait HasLabels
{
    protected static array $labels = [];

    /** @inheritDoc */
    public static function getLabels(): array
    {
        return static::$labels;
    }

    /** @inheritDoc */
    public static function getLabel(string $key): string
    {
        return static::$labels[$key] ?? '';
    }

    /** @inheritDoc */
    public static function withLabels(): array
    {
        //Override this method to define the labels for the taxonomy
        static::$labels = [];

        return static::getLabels();
    }
}
