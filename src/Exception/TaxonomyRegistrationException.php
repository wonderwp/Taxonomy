<?php

namespace WonderWp\Component\Taxonomy\Exception;

use WonderWp\Component\Response\Traits\HasWpError;

class TaxonomyRegistrationException extends \Exception
{
    use HasWpError;
}
