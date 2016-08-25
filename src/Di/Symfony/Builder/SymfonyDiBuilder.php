<?php
/**
 * Vain Framework
 *
 * PHP Version 7
 *
 * @package   vain-phalcon
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/allflame/vain-phalcon
 */
namespace Vain\Phalcon\Di\Symfony\Builder;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Vain\Phalcon\Di\Builder\DiBuilderInterface;
use Vain\Phalcon\Di\Symfony\SymfonyContainerAdapter;
use Vain\Phalcon\Exception\NoContainerException;
use Vain\Phalcon\Exception\UnableToCacheContainerException;

/**
 * Class SymfonyDiBuilder
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class SymfonyDiBuilder implements DiBuilderInterface
{
    /**
     * @var SymfonyContainerBuilder
     */
    private $container;

    private $appDir;

    private $configDir;

    private $applicationEnv = null;

    private $extensions = [];

    private $compilePasses = [];

    private $dump = false;

    /**
     * @inheritDoc
     */
    public function container($container)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function appDir($appDir)
    {
        $this->appDir = $appDir;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function configDir($configDir)
    {
        $this->configDir = $configDir;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function compilePasses(array $compilePasses)
    {
        $this->compilePasses = $compilePasses;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function config($applicationEnv)
    {
        $this->applicationEnv = $applicationEnv;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function extensions(array $extensions)
    {
        $this->extensions = $extensions;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function dump($dump = true)
    {
        $this->dump = $dump;

        return $this;
    }

    /**
     * @param SymfonyContainerBuilder $container
     * @param string                  $containerPath
     *
     * @return SymfonyContainerBuilder
     *
     * @throws UnableToCacheContainerException
     */
    protected function dumpContainer(SymfonyContainerBuilder $container, $containerPath)
    {
        if (false === file_exists(dirname($containerPath))) {
            mkdir(dirname($containerPath), 0755, true);
        }
        $dumper = new PhpDumper($container);
        if (false === file_put_contents($containerPath, $dumper->dump(['class' => 'CachedSymfonyContainer']))) {
            throw new UnableToCacheContainerException($this, $containerPath);
        }

        return $container;
    }

    /**
     * @param SymfonyContainerBuilder $container
     * @param string                  $appDir
     * @param string                  $configDir
     *
     * @return SymfonyContainerBuilder
     */
    protected function readConfig(SymfonyContainerBuilder $container, $appDir, $configDir)
    {
        $loader = new YamlFileLoader($this->container, new FileLocator($appDir));
        $diConfig = sprintf(
            '%s/%s/%s/di.yml',
            $appDir,
            $configDir,
            $this->applicationEnv
        );
        $loader->load($diConfig);

        return $container;
    }

    /**
     * @param SymfonyContainerBuilder $container
     * @param CompilerPassInterface[] $compilePasses
     *
     * @return SymfonyContainerBuilder
     */
    protected function addCompilePasses(SymfonyContainerBuilder $container, array $compilePasses)
    {
        foreach ($compilePasses as $compilePass) {
            $container->addCompilerPass($compilePass);
        }

        return $container;
    }

    /**
     * @param SymfonyContainerBuilder $container
     * @param ExtensionInterface[]    $extensions
     *
     * @return SymfonyContainerBuilder
     */
    protected function addExtensions(SymfonyContainerBuilder $container, array $extensions)
    {
        foreach ($extensions as $extension) {
            $extension->load([], $container);
        }

        return $container;
    }

    /**
     * @return SymfonyDiBuilder
     */
    protected function reset()
    {
        $this->dump = false;
        $this->extensions = $this->compilePasses = [];
        $this->applicationEnv = $this->container = $this->appDir = $this->configDir = null;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDi()
    {
        if (null === $this->container || null === $this->appDir || null === $this->configDir) {
            throw new NoContainerException($this);
        }

        if ([] !== $this->compilePasses) {
            $this->addCompilePasses($this->container, $this->compilePasses);
        }

        if ([] !== $this->extensions) {
            $this->addExtensions($this->container, $this->extensions);
        }

        if (null !== $this->applicationEnv) {
            $this->readConfig($this->container, $this->appDir, $this->configDir);
        }

        if ([] !== $this->extensions || [] !== $this->compilePasses) {
            $this->container->compile();
        }

        if (false !== $this->dump
            && $this->container->hasParameter('app.caching')
            && $this->container->hasParameter('app.container.path')
            && $this->container->getParameter('app.caching')
            && false === file_exists($containerPath = $this->container->getParameter('app.container.path'))
        ) {
            $this->dumpContainer($this->container, $containerPath);
        }

        $this->reset();

        return new SymfonyContainerAdapter($this->container);
    }
}
