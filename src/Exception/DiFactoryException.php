<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 12:08 PM
 */

namespace Vain\Phalcon\Exception;

use Vain\Core\Exception\CoreException;
use Vain\Phalcon\Di\Factory\DiFactoryInterface;

class DiFactoryException extends CoreException
{

    private $diFactory;

    /**
     * DiFactoryException constructor.
     * @param DiFactoryInterface $diFactory
     * @param string $message
     * @param int $code
     * @param \Exception $previous
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