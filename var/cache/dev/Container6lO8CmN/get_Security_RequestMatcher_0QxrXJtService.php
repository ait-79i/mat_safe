<?php

namespace Container6lO8CmN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_Security_RequestMatcher_0QxrXJtService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.security.request_matcher.0QxrXJt' shared service.
     *
     * @return \Symfony\Component\HttpFoundation\ChainRequestMatcher
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.security.request_matcher.0QxrXJt'] = new \Symfony\Component\HttpFoundation\ChainRequestMatcher([($container->privates['.security.request_matcher.lyVOED.'] ??= new \Symfony\Component\HttpFoundation\RequestMatcher\PathRequestMatcher('^/api/login'))]);
    }
}
