<?php

namespace WonderWp\Component\Taxonomy\Service;

use WonderWp\Component\PluginSkeleton\ManagerAwareInterface;
use WonderWp\Component\PluginSkeleton\ManagerAwareTrait;
use WonderWp\Component\PluginSkeleton\Service\RegistrableInterface;
use WonderWp\Component\Taxonomy\Definition\TaxonomyInterface;

class TaxonomyService extends AbstractTaxonomyService implements RegistrableInterface, ManagerAwareInterface
{
    use ManagerAwareTrait;

    public function register()
    {
        add_action('init', function(){
            $autoLoaded = $this->autoload();
        },9);
    }

    protected function autoloadFile(string $className, string $filePath): object
    {
        $instance = parent::autoloadFile($className, $filePath);

        if($instance instanceof TaxonomyInterface) {
            $this->addTaxonomy($instance);
        }

        return $instance;
    }


}
