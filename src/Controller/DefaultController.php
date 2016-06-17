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

/**
 * Class DefaultController
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class DefaultController extends AbstractController
{
    /**
     * @return DefaultController
     */
    public function indexAction()
    {
        $this->response->appendContent('Hello World');

        return $this;
    }
}