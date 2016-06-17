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
use Vain\Http\Cookie\Storage\CookieStorageInterface;
use Vain\Http\Request\VainServerRequestInterface;
use Vain\Http\Response\VainResponseInterface;

/**
 * Class AbstractController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 *
 * @property VainServerRequestInterface $request
 * @property VainResponseInterface $response
 * @property CookieStorageInterface $cookies
 */
class AbstractController extends PhalconMvcController
{
}