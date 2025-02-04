<?php

use WonderWp\Component\PluginSkeleton\Exception\ServiceNotFoundException;
use WonderWp\Component\PluginSkeleton\ManagerAwareInterface;
use WonderWp\Component\Service\ServiceInterface;
use WonderWp\Component\PluginSkeleton\ManagerInterface;
use WonderWp\Component\DependencyInjection\Container;
use WonderWp\Component\Taxonomy\Service\TaxonomyService;
use WonderWp\Component\Taxonomy\Service\TaxonomyServiceInterface;

add_action('wonderwp.loader.load', 'wwp_register_taxonomy_definitions_towards_container', 10, 2);
add_action('wwp.abstract_manager.run', 'wwp_register_taxonomy_service_towards_manager', 10, 2);

function wwp_register_taxonomy_definitions_towards_container(Container $container)
{
    $container['wwp.taxonomy.defaultService'] = $container->factory(function () {
        return new TaxonomyService();
    });
}

function wwp_register_taxonomy_service_towards_manager(ManagerInterface $manager, Container $container)
{
    // Taxonomies
    try {
        $taxonomyService = $manager->getService(ServiceInterface::TAXONOMY_SERVICE_NAME);
        if ($taxonomyService instanceof TaxonomyServiceInterface) {
            $taxonomyService->register();
        }
    } catch (ServiceNotFoundException $e) {
        if ($e->getServiceType() === ServiceInterface::TAXONOMY_SERVICE_NAME) {
            //No taxonomy service found, use the default one instead
            $taxonomyService = $container['wwp.taxonomy.defaultService'];
            if ($taxonomyService instanceof TaxonomyServiceInterface) {
                if($taxonomyService instanceof ManagerAwareInterface) {
                    $taxonomyService->setManager($manager);
                }
                $taxonomyService->register();
            }
        } else {
            throw $e;
        }
    }

}
