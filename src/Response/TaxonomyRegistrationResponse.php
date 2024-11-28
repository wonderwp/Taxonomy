<?php

namespace WonderWp\Component\Taxonomy\Response;

use WonderWp\Component\HttpFoundation\Result;
use WonderWp\Component\Response\AbstractResponse;
use \WP_Taxonomy;

class TaxonomyRegistrationResponse extends AbstractResponse implements TaxonomyRegistrationResponseInterface
{
    protected ?WP_Taxonomy $wpRegistrationResult = null;

    public function getWpRegistrationResult(): ?WP_Taxonomy
    {
        return $this->wpRegistrationResult;
    }

    public function setWpRegistrationResult(?WP_Taxonomy $wpRegistrationResult): void
    {
        $this->wpRegistrationResult = $wpRegistrationResult;
    }
}
