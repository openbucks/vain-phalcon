<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 11:48 AM
 */
namespace Vain\Phalcon\Di\Factory;

use \Phalcon\DiInterface as PhalconDiInterface;

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