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
namespace Vain\Phalcon\Di\Factory\Decorator\Config;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Vain\Phalcon\Di\Factory\Decorator\AbstractDiFactoryDecorator;
use Symfony\Component\DependencyInjection\ContainerInterface as SymfonyContainerInterface;

/**
 * Class ConfigDiFactoryDecorator
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class ConfigDiFactoryDecorator extends AbstractDiFactoryDecorator
{
    /**
     * @inheritDoc
     */
    public function createDi($applicationEnv, $cachingEnabled)
    {
        /**
         * @var SymfonyContainerInterface $diContainer
         */
        $diContainer = parent::createDi($applicationEnv, $cachingEnabled);

        $loader = new YamlFileLoader($diContainer, new FileLocator($diContainer->getParameter('app.dir')));
        $diConfig = sprintf('%s/%s/%s/di.yml', $diContainer->getParameter('app.dir'), $diContainer->getParameter('app.config.dir'), $applicationEnv);
        $loader->load($diConfig);

        return $diContainer;
    }
}