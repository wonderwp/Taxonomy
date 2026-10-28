<?php
/**
 * Integration smoke: register a throwaway taxonomy via TaxonomyService.
 *
 * Run from ANY WordPress project where wonderwp/taxonomy is installed:
 *
 *   wp eval-file vendor/wonderwp/taxonomy/tests/Integration/smoke-taxonomy-register.php
 *   ddev wp eval-file vendor/wonderwp/taxonomy/tests/Integration/smoke-taxonomy-register.php
 */

use WonderWp\Component\Taxonomy\Definition\AbstractTaxonomy;
use WonderWp\Component\Taxonomy\Service\TaxonomyService;

if (!defined('ABSPATH')) {
    fwrite(STDERR, "WordPress is not loaded. Run via WP-CLI from a project that requires wonderwp/taxonomy.\n");
    exit(1);
}

$autoloadCandidates = [
    dirname(__DIR__, 4) . '/autoload.php',
    dirname(__DIR__, 2) . '/vendor/autoload.php',
];
foreach ($autoloadCandidates as $autoload) {
    if (is_file($autoload)) {
        require_once $autoload;
        break;
    }
}

if (!class_exists(TaxonomyService::class)) {
    fwrite(STDERR, "wonderwp/taxonomy is not autoloadable from this WordPress project.\n");
    exit(1);
}

final class WwpSmokeTaxonomy extends AbstractTaxonomy
{
}

$taxonomyKey = 'wwp_smoke_tax';
$service = new TaxonomyService();
$service->addTaxonomy(new WwpSmokeTaxonomy($taxonomyKey, ['post'], [
    'public' => false,
    'show_ui' => false,
    'label' => 'WWP Smoke Taxonomy',
]));

$response = $service->registerTaxonomy($service->getTaxonomy($taxonomyKey));

if ($response->getMsgKey() !== 'Taxonomy.registration.success') {
    fwrite(STDERR, "Taxonomy registration failed: " . ($response->getError()?->getMessage() ?? 'unknown') . "\n");
    exit(1);
}

if (!taxonomy_exists($taxonomyKey)) {
    fwrite(STDERR, "taxonomy_exists('$taxonomyKey') is false after registration.\n");
    exit(1);
}

fwrite(STDOUT, "OK wonderwp/taxonomy Integration smoke-taxonomy-register ($taxonomyKey)\n");
