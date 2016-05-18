<?php
/**
 * Created by PhpStorm.
 * User: allflame
 * Date: 5/16/16
 * Time: 9:13 AM
 */

namespace Vain\Phalcon\Exception;

use Vain\Core\Exception\CoreException;
use Vain\Http\Request\Factory\RequestFactoryInterface;

class HttpFactoryException extends CoreException
{
    private $httpFactory;

    /**
     * HttpFactoryException constructor.
     * @param RequestFactoryInterface $factory
     * @param string $message
     * @param int $code
     * @param \Exception $previous
     */
    public function __construct(RequestFactoryInterface $factory, $message, $code, \Exception $previous = null)
    {
        $this->httpFactory = $factory;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return RequestFactoryInterface
     */
    public function getHttpFactory()
    {
        return $this->httpFactory;
    }


}