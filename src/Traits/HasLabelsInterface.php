<?php

namespace WonderWp\Component\Taxonomy\Traits;

interface HasLabelsInterface
{
    /**
     * Returns the labels for the taxonomy.
     * @see https://developer.wordpress.org/reference/functions/get_taxonomy_labels/
     *
     * @return array
     */
    public static function getLabels(): array;

    /**
     * Returns the label for the given key.
     *
     * @param string $key
     *
     * @return string
     */
    public static function getLabel(string $key): string;

    /**
     * Use this method to define the labels for the taxonomy (by filling static::$labels).
     * @return void
     */
    public static function provideLabels(): array;
}
