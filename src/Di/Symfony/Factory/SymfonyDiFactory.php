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

use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Vain\Phalcon\Di\Factory\DiFactoryInterface;

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
     *
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
     * @param string $applicationPath
     * @param string $applicationMode
     * @param string $configDir
     * @param string $applicationEnv
     * @param bool   $isDebug
     * @param bool   $cachingEnabled
     * @param string $containerPath
     *
     * @return SymfonyContainerBuilder
     */
    protected function createContainer(
        string $applicationPath,
        string $configDir,
        string $applicationEnv,
        string $applicationMode,
        bool $isDebug,
        bool $cachingEnabled,
        string $containerPath
    ) {
        $builder = new SymfonyContainerBuilder;
        $builder->setParameter('app.dir', $applicationPath);
        $builder->setParameter('app.env', $applicationEnv);
        $builder->setParameter('app.mode', $applicationMode);
        $builder->setParameter('app.debug', $isDebug);
        $builder->setParameter('app.caching', $cachingEnabled);
        $builder->setParameter('app.container.path', $containerPath);
        $builder->setParameter('config.dir', $configDir);
        $builder->setParameter('cache.dir', $this->cacheDir);

        return $builder;
    }

    /**
     * @param string $applicationPath
     * @param string $cacheDir
     * @param string $applicationEnv
     * @paarm string $applicationMode
     *
     * @return string
     */
    protected function getCachedContainerPath($applicationPath, $cacheDir, $applicationEnv, $applicationMode)
    {
        return sprintf('%s/%s/container/di_%s_%s.php', $applicationPath, $cacheDir, $applicationEnv, $applicationMode);
    }

    /**
     * @inheritDoc
     */
    public function createDi(string $applicationEnv, string $applicationMode, bool $isDebug, bool $cachingEnabled)
    {
        $containerPath = $this->getCachedContainerPath($this->applicationPath, $this->cacheDir, $applicationEnv, $applicationMode);
        if (false === $cachingEnabled || false === file_exists($containerPath)) {
            return $this->createContainer(
                $this->applicationPath,
                $this->configDir,
                $applicationEnv,
                $applicationMode,
                $isDebug,
                $cachingEnabled,
                $containerPath
            );
        }
        require_once $containerPath;

        return new \CachedSymfonyContainer();
    }
}
