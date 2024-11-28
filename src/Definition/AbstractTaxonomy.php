<?php

namespace WonderWp\Component\Taxonomy\Definition;

abstract class AbstractTaxonomy implements TaxonomyInterface
{
    protected string $key;
    protected array $objectTypes = [];
    protected array $args = [];

    /**
     * @param string $key
     * @param array $objectTypes
     * @param array $args
     */
    public function __construct(string $key, array $objectTypes, array $args)
    {
        $this->key = $key;
        $this->objectTypes = $objectTypes;
        $this->args = $args;
    }

    /** @inheritDoc */
    public function getKey(): string
    {
        return $this->key;
    }

    public function getObjectTypes(): array
    {
        return $this->objectTypes;
    }

    public function setObjectTypes(array $objectTypes): static
    {
        $this->objectTypes = $objectTypes;

        return $this;
    }


    /** @inheritDoc */
    public function setKey(string $key): static
    {
        $this->key = $key;

        return $this;
    }

    /** @inheritDoc */
    public function getArgs(): array
    {
        return $this->args;
    }

    /** @inheritDoc */
    public function setArgs(array $args): static
    {
        $this->args = $args;

        return $this;
    }

    /** @inheritDoc */
    public function getArg(string $key): mixed
    {
        return $this->args[$key] ?? null;
    }

    /** @inheritDoc */
    public function setArg(string $key, mixed $value): static
    {
        $this->args[$key] = $value;

        return $this;
    }

}
