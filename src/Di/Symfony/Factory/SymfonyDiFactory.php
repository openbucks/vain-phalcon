<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 11:50 AM
 */

namespace Vain\Phalcon\Di\Symfony\Factory;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Vain\Phalcon\Di\Factory\DiFactoryInterface;
use Vain\Phalcon\Di\Symfony\SymfonyContainerAdapter;
use Vain\Phalcon\Exception\UnableToCacheContainerException;

class SymfonyDiFactory implements DiFactoryInterface
{

    private $applicationPath;

    private $configFile;

    private $cacheFile;

    /**
     * SymfonyDiFactory constructor.
     * @param string $applicationDir
     * @param string $configFile
     * @param string $cacheFile
     */
    public function __construct($applicationDir, $configFile, $cacheFile)
    {
        $this->applicationPath = $applicationDir;
        $this->configFile = $configFile;
        $this->cacheFile = $cacheFile;
    }

    /**
     * @return SymfonyContainerBuilder
     */
    protected function createContainer()
    {
        $builder = new SymfonyContainerBuilder;
        $loader = new YamlFileLoader($builder, new FileLocator($this->applicationPath));
        $loader->load($this->configFile);
        $builder->compile();

        return $builder;
    }

    protected function dumpContainer(SymfonyContainerBuilder $container, $file)
    {
        $dumper = new PhpDumper($container);

        if (false === file_exists(dirname($file))) {
            mkdir(dirname($file), 0755, true);
        }

        if (false === file_put_contents($file, $dumper->dump(['class' => 'CachedSymfonyContainer']))) {
            throw new UnableToCacheContainerException($this, $file);
        }

        return $container;
    }

    /**
     * @inheritDoc
     */
    public function createDi()
    {
        $cachedContainerSource = $this->applicationPath . DIRECTORY_SEPARATOR . $this->cacheFile ;
        if (false === file_exists($cachedContainerSource)) {
            $container = $this->dumpContainer($this->createContainer(), $cachedContainerSource);

            return new SymfonyContainerAdapter($container);
        }

        require_once $cachedContainerSource;

        return new SymfonyContainerAdapter(new CachedSymfonyContainer());
    }
}