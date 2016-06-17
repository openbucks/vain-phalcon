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
        $builder->setParameter('app.dir', $this->applicationPath);
        $builder->compile();

        return $builder;
    }

    /**
     * @param SymfonyContainerBuilder $container
     * @param string $file
     * 
     * @return SymfonyContainerBuilder
     * 
     * @throws UnableToCacheContainerException
     */
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

            $container = new SymfonyContainerAdapter($container);

            return $container;
        }

        require_once $cachedContainerSource;

        return new SymfonyContainerAdapter(new \CachedSymfonyContainer());
    }
}