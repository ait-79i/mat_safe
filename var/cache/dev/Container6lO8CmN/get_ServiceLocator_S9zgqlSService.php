<?php

namespace Container6lO8CmN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_S9zgqlSService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.S9zgqlS' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.S9zgqlS'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'rep' => ['privates', 'App\\Repository\\TacheRepository', 'getTacheRepositoryService', true],
        ], [
            'rep' => 'App\\Repository\\TacheRepository',
        ]);
    }
}