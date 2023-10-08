<?php

namespace Container6lO8CmN;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getSecurity_Authenticator_Jwt_ApiService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'security.authenticator.jwt.api' shared service.
     *
     * @return \Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Authenticator/AuthenticatorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/Authenticator/AbstractAuthenticator.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/security-http/EntryPoint/AuthenticationEntryPointInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/lexik/jwt-authentication-bundle/Security/Authenticator/ForwardCompatAuthenticatorTrait.php';
        include_once \dirname(__DIR__, 4).'/vendor/lexik/jwt-authentication-bundle/Security/Authenticator/JWTAuthenticator.php';
        include_once \dirname(__DIR__, 4).'/vendor/lexik/jwt-authentication-bundle/TokenExtractor/TokenExtractorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/lexik/jwt-authentication-bundle/TokenExtractor/ChainTokenExtractor.php';
        include_once \dirname(__DIR__, 4).'/vendor/lexik/jwt-authentication-bundle/TokenExtractor/AuthorizationHeaderTokenExtractor.php';

        $a = ($container->services['lexik_jwt_authentication.jwt_manager'] ?? $container->load('getLexikJwtAuthentication_JwtManagerService'));

        if (isset($container->privates['security.authenticator.jwt.api'])) {
            return $container->privates['security.authenticator.jwt.api'];
        }
        $b = ($container->services['event_dispatcher'] ?? self::getEventDispatcherService($container));

        if (isset($container->privates['security.authenticator.jwt.api'])) {
            return $container->privates['security.authenticator.jwt.api'];
        }

        return $container->privates['security.authenticator.jwt.api'] = new \Lexik\Bundle\JWTAuthenticationBundle\Security\Authenticator\JWTAuthenticator($a, $b, new \Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\ChainTokenExtractor([new \Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor('Bearer', 'Authorization')]), ($container->privates['security.user.provider.concrete.app_user_provider'] ?? $container->load('getSecurity_User_Provider_Concrete_AppUserProviderService')), NULL);
    }
}
