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
namespace Vain\Phalcon\Exception;

use Vain\Core\Exception\AbstractCoreException;
use Vain\Phalcon\Di\Factory\DiFactoryInterface;

/**
 * Class DiFactoryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DiFactoryException extends AbstractCoreException
{
    private $diFactory;

    /**
     * DiFactoryException constructor.
     *
     * @param DiFactoryInterface $diFactory
     * @param string             $message
     * @param int                $code
     * @param \Exception         $previous
     */
    public function __construct(DiFactoryInterface $diFactory, $message, $code, \Exception $previous = null)
    {
        $this->diFactory = $diFactory;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return DiFactoryInterface
     */
    public function getDiFactory()
    {
        return $this->diFactory;
    }
}