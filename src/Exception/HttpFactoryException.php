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
use Vain\Http\Request\Factory\RequestFactoryInterface;

/**
 * Class HttpFactoryException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class HttpFactoryException extends AbstractCoreException
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