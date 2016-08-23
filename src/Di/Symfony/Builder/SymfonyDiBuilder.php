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
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Vain\Phalcon\Di\Builder\DiBuilderInterface;
use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Vain\Phalcon\Di\Symfony\SymfonyContainerAdapter;
use Vain\Phalcon\Exception\NoContainerException;
use Vain\Phalcon\Exception\NoCoreParametersException;
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

    private $compile = false;

    private $applicationEnv = null;

    private $extensions = false;

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
    public function compile($compile = true)
    {
        $this->compile = $compile;

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
    public function extensions($extensions = true)
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
     * @param string                  $appDir
     * @param string                  $configDir
     *
     * @return SymfonyContainerBuilder
     * @throws \Exception
     */
    protected function addExtensions(SymfonyContainerBuilder $container, $appDir, $configDir)
    {
        $extensionsFile = sprintf(
            '%s%s%s%sextensions.php',
            $appDir,
            DIRECTORY_SEPARATOR,
            $configDir,
            DIRECTORY_SEPARATOR
        );
        if (false === file_exists($extensionsFile)) {
            return $container;
        }
        $extensions = require_once $extensionsFile;
        foreach ($extensions as $extension) {
            $className = sprintf('Vain\%s\Extension\%sExtension', $extension, $extension);
            if (false === class_exists($className)) {
                throw new \Exception("Class $className");
            }
            (new $className)->load([], $container);
        }

        return $container;
    }

    /**
     * @return SymfonyDiBuilder
     */
    protected function reset()
    {
        $this->compile = $this->extensions = $this->dump = false;
        $this->applicationEnv = null;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDi()
    {
        if (null === $this->container) {
            throw new NoContainerException($this);
        }
        if (false === $this->container->hasParameter('app.dir')
            || false === $this->container->hasParameter('app.config.dir')
        ) {
            throw new NoCoreParametersException($this);
        }
        $appDir = $this->container->getParameter('app.dir');
        $configDir = $this->container->getParameter('app.config.dir');
        if (null !== $this->applicationEnv) {
            $this->readConfig($this->container, $appDir, $configDir);
        }
        if (false !== $this->extensions) {
            $this->addExtensions($this->container, $appDir, $configDir);
        }
        if (false !== $this->compile) {
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
