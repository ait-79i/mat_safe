<?php

namespace ContainerGi9YxqU;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator__W5wjefService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator..W5wjef' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator..W5wjef'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'adresseRepo' => ['privates', 'App\\Repository\\AdresseRepository', 'getAdresseRepositoryService', true],
            'compagnie' => ['privates', '.errored..service_locator..W5wjef.App\\Entity\\Compagnie', NULL, 'Cannot autowire service ".service_locator..W5wjef": it needs an instance of "App\\Entity\\Compagnie" but this type has been excluded in "config/services.yaml".'],
            'manager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', true],
            'userRepository' => ['privates', 'App\\Repository\\UserRepository', 'getUserRepositoryService', true],
        ], [
            'adresseRepo' => 'App\\Repository\\AdresseRepository',
            'compagnie' => 'App\\Entity\\Compagnie',
            'manager' => '?',
            'userRepository' => 'App\\Repository\\UserRepository',
        ]);
    }
}