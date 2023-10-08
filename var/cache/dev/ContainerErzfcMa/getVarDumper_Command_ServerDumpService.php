<?php

namespace ContainerErzfcMa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getVarDumper_Command_ServerDumpService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'var_dumper.command.server_dump' shared service.
     *
     * @return \Symfony\Component\VarDumper\Command\ServerDumpCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Command/ServerDumpCommand.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Server/DumpServer.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Command/Descriptor/DumpDescriptorInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Command/Descriptor/CliDescriptor.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Command/Descriptor/HtmlDescriptor.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Dumper/DataDumperInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Cloner/DumperInterface.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Dumper/AbstractDumper.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Dumper/CliDumper.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/var-dumper/Dumper/HtmlDumper.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/http-kernel/Debug/FileLinkFormatter.php';

        $a = new \Symfony\Component\VarDumper\Dumper\HtmlDumper(NULL, 'UTF-8', 0);
        $a->setDisplayOptions(['fileLinkFormat' => ($container->privates['debug.file_link_formatter'] ??= new \Symfony\Component\HttpKernel\Debug\FileLinkFormatter($container->getEnv('default::SYMFONY_IDE')))]);

        $container->privates['var_dumper.command.server_dump'] = $instance = new \Symfony\Component\VarDumper\Command\ServerDumpCommand(new \Symfony\Component\VarDumper\Server\DumpServer('tcp://'.$container->getEnv('string:VAR_DUMPER_SERVER'), ($container->privates['logger'] ?? self::getLoggerService($container))), ['cli' => new \Symfony\Component\VarDumper\Command\Descriptor\CliDescriptor(($container->privates['var_dumper.contextualized_cli_dumper.inner'] ?? $container->load('getVarDumper_ContextualizedCliDumper_InnerService'))), 'html' => new \Symfony\Component\VarDumper\Command\Descriptor\HtmlDescriptor($a)]);

        $instance->setName('server:dump');
        $instance->setDescription('Start a dump server that collects and displays dumps in a single place');

        return $instance;
    }
}
