<?php

namespace WonderWp\Component\Taxonomy\Service;

use WonderWp\Component\Taxonomy\Definition\TaxonomyInterface;
use WonderWp\Component\Taxonomy\Exception\TaxonomyRegistrationException;
use WonderWp\Component\Taxonomy\Response\TaxonomyRegistrationResponse;
use WonderWp\Component\Taxonomy\Response\TaxonomyRegistrationResponseInterface;
use WonderWp\Component\Service\AbstractService;

abstract class AbstractTaxonomyService extends AbstractService implements TaxonomyServiceInterface
{
    /** @var TaxonomyInterface[] */
    protected $taxonomies = [];

    //========================================================================================================//
    // Getters and Setters
    //========================================================================================================//

    /** @inheritDoc */
    public function getTaxonomies(): array
    {
        return $this->taxonomies;
    }

    /** @inheritDoc */
    public function getTaxonomy(string $key): ?TaxonomyInterface
    {
        return $this->taxonomies[$key] ?? null;
    }

    /** @inheritDoc */
    public function addTaxonomy(TaxonomyInterface $taxonomy): static
    {
        $this->taxonomies[$taxonomy->getKey()] = $taxonomy;
        return $this;
    }

    /** @inheritDoc */
    public function removeTaxonomy(string $key): static
    {
        if (isset($this->taxonomies[$key])) {
            unset($this->taxonomies[$key]);
        }
        return $this;
    }

    /** @inheritDoc */
    public function setTaxonomies(array $taxonomies): static
    {
        $this->taxonomies = $taxonomies;
        return $this;
    }

    //========================================================================================================//
    // Registration methods
    //========================================================================================================//

    /** @inheritDoc */
    public function registerTaxonomies(): array
    {
        $responses = [];

        foreach ($this->taxonomies as $taxonomy) {
            $responses[$taxonomy->getKey()] = $this->registerTaxonomy($taxonomy);
        }

        return $responses;
    }

    /** @inheritDoc */
    public function registerTaxonomy(TaxonomyInterface $taxonomy): TaxonomyRegistrationResponseInterface
    {
        try {
            $wpRes = register_taxonomy($taxonomy->getKey(), $taxonomy->getArgs());

            if ($wpRes instanceof \WP_Error) {
                throw new TaxonomyRegistrationException($wpRes->get_error_message(), $wpRes->get_error_code());
            } else {
                $response = new TaxonomyRegistrationResponse(200, TaxonomyRegistrationResponseInterface::SUCCESS);
                $response->setWpRegistrationResult($wpRes);
            }
        } catch (\Exception $e) {
            $errorCode = is_int($e->getCode()) ? $e->getCode() : 500;
            $response = new TaxonomyRegistrationResponse($errorCode, TaxonomyRegistrationResponseInterface::ERROR);
            $response->setError($e);
        }

        return $response;
    }
}
