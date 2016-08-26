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

use Vain\Http\Request\Factory\RequestFactoryInterface;

/**
 * Class UnknownFilesException
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class UnknownFilesException extends HttpFactoryException
{
    /**
     * UnknownFilesException constructor.
     *
     * @param RequestFactoryInterface $factory
     * @param string                  $fileKey
     */
    public function __construct(RequestFactoryInterface $factory, $fileKey)
    {
        parent::__construct($factory, sprintf('Cannot parse files array at key %s', $fileKey), 0, null);
    }
}