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
namespace Vain\Phalcon\Event\Listener\Factory;

use Phalcon\DiInterface as PhalconDiInterface;
use Vain\Event\Listener\Factory\ListenerFactoryInterface;

/**
 * Class PhalconListenerFactory
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconListenerFactory implements ListenerFactoryInterface
{

    private $di;

    /**
     * PhalconListenerFactory constructor.
     *
     * @param PhalconDiInterface $di
     */
    public function __construct(PhalconDiInterface $di)
    {
        $this->di = $di;
    }

    /**
     * @inheritDoc
     */
    public function create($name)
    {
        return $this->di->getShared($name);
    }
}