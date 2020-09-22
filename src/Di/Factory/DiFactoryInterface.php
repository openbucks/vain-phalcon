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
namespace Vain\Phalcon\Di\Factory;

use \Phalcon\Di\DiInterface as PhalconDiInterface;

/**
 * Interface DiFactoryInterface
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
interface DiFactoryInterface
{
    /**
     * @param string $applicationEnv
     * @param string $applicationMode
     * @param bool   $isDebug
     * @param bool   $cachingEnabled
     *
     * @return PhalconDiInterface
     */
    public function createDi(string $applicationEnv, string $applicationMode, bool $isDebug, bool $cachingEnabled);
}
