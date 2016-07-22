<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-http
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-http
 */
namespace Vain\Phalcon\Di\Symfony\Factory;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Vain\Phalcon\Di\Factory\DiFactoryInterface;
use Vain\Phalcon\Di\Symfony\SymfonyContainerAdapter;
use Vain\Phalcon\Exception\UnableToCacheContainerException;

/**
 * Class SymfonyDiFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SymfonyDiFactory implements DiFactoryInterface
{

    private $applicationPath;

    private $configDir;

    private $cacheDir;

    /**
     * SymfonyDiFactory constructor.
     * @param string $applicationDir
     * @param string $configDir
     * @param string $cacheDir
     */
    public function __construct($applicationDir, $configDir, $cacheDir)
    {
        $this->applicationPath = $applicationDir;
        $this->configDir = $configDir;
        $this->cacheDir = $cacheDir;
    }

    /**
     * @return SymfonyContainerBuilder
     */
    protected function createContainer($applicationPath, $configDir, $applicationEnv, $cachingEnabled)
    {
        $builder = new SymfonyContainerBuilder;
        $loader = new YamlFileLoader($builder, new FileLocator($applicationPath));
        $diConfig = sprintf('%s/%s/%s/di.yml', $applicationPath, $configDir, $applicationEnv);
        $loader->load($diConfig);
        $builder->setParameter('app.dir', $applicationPath);
        $builder->setParameter('app.env', $applicationEnv);
        $builder->setParameter('app.config.dir', $configDir);
        $builder->setParameter('app.cache.dir', $this->cacheDir);
        $builder->setParameter('app.caching', $cachingEnabled);

        $builder->compile();

        return $builder;
    }

    /**
     * @param string $applicationPath
     * @param string $cacheDir
     * @param string $applicationEnv
     *
     * @return string
     */
    protected function getCachedContainerPath($applicationPath, $cacheDir, $applicationEnv)
    {
        return sprintf('%s/%s/container/di_%s.php', $applicationPath, $cacheDir, $applicationEnv);
    }

    /**
     * @param SymfonyContainerBuilder $container
     * @param string $containerPath
     *
     * @return SymfonyContainerBuilder
     *
     * @throws UnableToCacheContainerException
     */
    protected function dumpContainer(SymfonyContainerBuilder $container, $containerPath)
    {
        $dumper = new PhpDumper($container);

        if (false === file_exists(dirname($containerPath))) {
            mkdir(dirname($containerPath), 0755, true);
        }

        if (false === file_put_contents($containerPath, $dumper->dump(['class' => 'CachedSymfonyContainer']))) {
            throw new UnableToCacheContainerException($this, $containerPath);
        }

        return $container;
    }

    /**
     * @inheritDoc
     */
    public function createDi()
    {
        $applicationEnv = defined('APPLICATION_ENV') ? APPLICATION_ENV : 'dev';
        $cachingEnabled = defined('APPLICATION_CACHE') ? (bool)APPLICATION_CACHE : false;

        if (false === $cachingEnabled) {
            $container = $this->createContainer($this->applicationPath, $this->configDir, $applicationEnv, $cachingEnabled);

            return new SymfonyContainerAdapter($container);
        }

        $containerPath = $this->getCachedContainerPath($this->applicationPath, $this->cacheDir, $applicationEnv);
        if (false === file_exists($containerPath)) {
            $container = $this->dumpContainer($this->createContainer($this->applicationPath, $this->configDir, $applicationEnv, $cachingEnabled), $containerPath);

            return new SymfonyContainerAdapter($container);
        }

        require_once $containerPath;

        return new SymfonyContainerAdapter(new \CachedSymfonyContainer());
    }
}