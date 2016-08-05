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
namespace Vain\Phalcon\Di\Compile;

use Vain\Phalcon\Di\Factory\Decorator\Adapter\AdapterDiFactoryDecorator;
use Vain\Phalcon\Di\Factory\Decorator\Compile\CompileDiFactoryDecorator;
use Vain\Phalcon\Di\Factory\Decorator\Config\ConfigDiFactoryDecorator;
use Vain\Phalcon\Di\Factory\Decorator\Dump\DumpDiFactoryDecorator;
use Vain\Phalcon\Di\Factory\Decorator\Extension\ExtensionDiFactoryDecorator;
use Vain\Phalcon\Di\Factory\DiFactoryInterface;
use Vain\Phalcon\Di\Symfony\Factory\SymfonyDiFactory;

/**
 * Class CompileDiFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class CompileDiFactory implements DiFactoryInterface
{
    private $applicationDir;

    private $configDir;

    private $cacheDir;

    /**
     * CompileDiFactory constructor.
     *
     * @param $applicationDir
     * @param $configDir
     * @param $cacheDir
     */
    public function __construct($applicationDir, $configDir, $cacheDir)
    {
        $this->applicationDir = $applicationDir;
        $this->configDir = $configDir;
        $this->cacheDir = $cacheDir;
    }

    /**
     * @inheritDoc
     */
    public function createDi($applicationEnv, $cachingEnabled)
    {
        return (
        new AdapterDiFactoryDecorator(
            new DumpDiFactoryDecorator(
                new CompileDiFactoryDecorator(
                    new ConfigDiFactoryDecorator(
                        new ExtensionDiFactoryDecorator(
                            new SymfonyDiFactory($this->applicationDir, $this->configDir, $this->cacheDir)
                        )
                    )
                )
            )
        ))->createDi($applicationEnv, $cachingEnabled);
    }
}