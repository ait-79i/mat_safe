<?php

namespace ContainerErzfcMa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_PTsd_1bService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.PTsd.1b' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.PTsd.1b'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'doctrine' => ['services', 'doctrine', 'getDoctrineService', true],
            'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', true],
            'passwordHasher' => ['privates', 'security.user_password_hasher', 'getSecurity_UserPasswordHasherService', true],
            'repository' => ['privates', 'App\\Repository\\CompagnieRepository', 'getCompagnieRepositoryService', true],
            'roleRepository' => ['privates', 'App\\Repository\\RoleRepository', 'getRoleRepositoryService', true],
        ], [
            'doctrine' => '?',
            'entityManager' => '?',
            'passwordHasher' => '?',
            'repository' => 'App\\Repository\\CompagnieRepository',
            'roleRepository' => 'App\\Repository\\RoleRepository',
        ]);
    }
}
