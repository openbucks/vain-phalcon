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
namespace Vain\Phalcon\Di\Factory\Decorator\Dump;

use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Vain\Phalcon\Di\Compile\CompileAwareContainerInterface;
use Vain\Phalcon\Di\Factory\Decorator\AbstractDiFactoryDecorator;
use Vain\Phalcon\Exception\UnableToCacheContainerException;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;

/**
 * Class DumpDiFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DumpDiFactoryDecorator extends AbstractDiFactoryDecorator
{
    /**
     * @param CompileAwareContainerInterface $container
     * @param string                         $containerPath
     *
     * @return CompileAwareContainerInterface
     *
     * @throws UnableToCacheContainerException
     */
    protected function dumpContainer(CompileAwareContainerInterface $container, $containerPath)
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
    public function createDi($applicationEnv, $cachingEnabled)
    {
        /**
         * @var SymfonyContainerInterface $diContainer
         */
        $diContainer = parent::createDi($applicationEnv, $cachingEnabled);

        if ($diContainer->hasParameter('app.caching')
            && $diContainer->hasParameter('app.container.path')
            && $diContainer->getParameter('app.caching')
            && false === file_exists($containerPath = $diContainer->getParameter('app.container.path'))
        ) {
            $this->dumpContainer($diContainer, $containerPath);
        }

        return $diContainer;
    }
}