<?php

namespace WonderWp\Component\Taxonomy\Definition;

interface TaxonomyInterface
{
    /**
     * Get the taxonomy key.
     * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
     * @return string
     */
    public function getKey(): string;

    /**
     * Set the taxonomy key.
     * Must not exceed 32 characters and may only contain lowercase alphanumeric characters, dashes, and underscores.
     * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
     * @see https://developer.wordpress.org/reference/functions/sanitize_key/
     * @param $key
     * @return $this
     */
    public function setKey(string $key): static;

    /**
     * Return the array of object types with which the taxonomy should be associated to.
     * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
     * @return string[]
     */
    public function getObjectTypes(): array;

    /**
     * Set the array of object types with which the taxonomy should be associated to.
     * @param string[] $objectTypes
     * @return $this
     * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
     */
    public function setObjectTypes(array $objectTypes): static;

    /**
     * Return the taxonomy args, that will be passed to register_taxonomy
     * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
     * @return array
     */
    public function getArgs(): array;

    /**
     * Set the taxonomy args that will be passed to register_taxonomy
     * @see https://developer.wordpress.org/reference/functions/register_taxonomy/
     * @param array $args
     * @return $this
     */
    public function setArgs(array $args): static;

    /**
     * Return a specific arg
     * @param string $key
     * @return mixed
     */
    public function getArg(string $key): mixed;

    /**
     * Set a specific arg
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function setArg(string $key, mixed $value): static;
}
