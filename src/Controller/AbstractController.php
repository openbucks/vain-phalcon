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

namespace Vain\Phalcon\Controller;

use Phalcon\Mvc\Controller as PhalconMvcController;
use Vain\Core\Http\Cookie\Storage\CookieStorageInterface;
use Vain\Core\Http\Request\VainServerRequestInterface;
use Vain\Core\Http\Response\VainResponseInterface;

/**
 * Class AbstractController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @property VainServerRequestInterface $request
 * @property VainResponseInterface      $response
 * @property CookieStorageInterface     $cookies
 */
abstract class AbstractController extends PhalconMvcController
{
}
