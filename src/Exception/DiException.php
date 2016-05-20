<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/20/16
 * Time: 11:38 AM
 */

namespace Vain\Phalcon\Exception;

use Phalcon\DiInterface as PhalconDiInterface;
use Vain\Core\Exception\CoreException;

class DiException extends CoreException
{
    private $di;

    /**
     * DiException constructor.
     * @param PhalconDiInterface $di
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct(PhalconDiInterface $di, $message, $code, \Exception $previous = null)
    {
        $this->di = $di;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return PhalconDiInterface
     */
    public function getDi()
    {
        return $this->di;
    }
}