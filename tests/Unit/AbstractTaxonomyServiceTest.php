<?php

declare(strict_types=1);

namespace WonderWp\Component\Taxonomy\Tests\Unit;

use PHPUnit\Framework\TestCase;
use WonderWp\Component\Taxonomy\Definition\TaxonomyInterface;
use WonderWp\Component\Taxonomy\Response\TaxonomyRegistrationResponseInterface;
use WonderWp\Component\Taxonomy\Service\AbstractTaxonomyService;
use WP_Error;
use WP_Taxonomy;

final class AbstractTaxonomyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        $GLOBALS['wwp_test_register_taxonomy_calls'] = [];
        unset($GLOBALS['wwp_test_register_taxonomy_return']);
    }

    public function testRegisterTaxonomySuccess(): void
    {
        $service = new TestableTaxonomyService();
        $taxonomy = new StubTaxonomy('genre', ['book'], ['public' => true]);

        $response = $service->registerTaxonomy($taxonomy);

        $this->assertSame(200, $response->getCode());
        $this->assertSame(TaxonomyRegistrationResponseInterface::SUCCESS, $response->getMsgKey());
        $this->assertInstanceOf(WP_Taxonomy::class, $response->getWpRegistrationResult());
        $this->assertCount(1, $GLOBALS['wwp_test_register_taxonomy_calls']);
        $this->assertSame('genre', $GLOBALS['wwp_test_register_taxonomy_calls'][0]['taxonomy']);
        $this->assertSame(['book'], $GLOBALS['wwp_test_register_taxonomy_calls'][0]['object_type']);
    }

    public function testRegisterTaxonomyMapsWpErrorToErrorResponse(): void
    {
        $GLOBALS['wwp_test_register_taxonomy_return'] = new WP_Error('invalid_taxonomy', 'Invalid taxonomy');

        $service = new TestableTaxonomyService();
        $response = $service->registerTaxonomy(new StubTaxonomy('bad_tax', ['post'], []));

        $this->assertSame(TaxonomyRegistrationResponseInterface::ERROR, $response->getMsgKey());
        $this->assertSame(500, $response->getCode());
        $this->assertSame('Invalid taxonomy', $response->getError()?->getMessage());
    }

    public function testRegisterTaxonomiesReturnsKeyedResponses(): void
    {
        $service = new TestableTaxonomyService();
        $service->addTaxonomy(new StubTaxonomy('genre', ['book'], []));
        $service->addTaxonomy(new StubTaxonomy('author_tag', ['book'], []));

        $responses = $service->registerTaxonomies();

        $this->assertCount(2, $responses);
        $this->assertArrayHasKey('genre', $responses);
        $this->assertArrayHasKey('author_tag', $responses);
        $this->assertSame(TaxonomyRegistrationResponseInterface::SUCCESS, $responses['genre']->getMsgKey());
    }
}

final class TestableTaxonomyService extends AbstractTaxonomyService
{
    public function register(): void
    {
    }
}

final class StubTaxonomy implements TaxonomyInterface
{
    public function __construct(
        private string $key,
        private array $objectTypes,
        private array $args
    ) {
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key): static
    {
        $this->key = $key;

        return $this;
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

    public function getArgs(): array
    {
        return $this->args;
    }

    public function setArgs(array $args): static
    {
        $this->args = $args;

        return $this;
    }

    public function getArg(string $key): mixed
    {
        return $this->args[$key] ?? null;
    }

    public function setArg(string $key, mixed $value): static
    {
        $this->args[$key] = $value;

        return $this;
    }
}
