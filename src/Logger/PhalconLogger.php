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
declare(strict_types = 1);

namespace Vain\Phalcon\Logger;

use Phalcon\Logger\AdapterInterface as PhalconLoggerInstance;
use Phalcon\Logger\FormatterInterface;
use Psr\Log\LoggerInterface as PsrLoggerInterface;

/**
 * Class PhalconLogger
 *
 * @author Taras P. Girnyk <taras.p.gyrnik@gmail.com>
 */
class PhalconLogger implements PsrLoggerInterface, PhalconLoggerInstance
{
    private $phalconInstance;

    /**
     * PhalconLogger constructor.
     *
     * @param PhalconLoggerInstance $phalconInstance
     */
    public function __construct(PhalconLoggerInstance $phalconInstance)
    {
        $this->phalconInstance = $phalconInstance;
    }

    /**
     * @inheritDoc
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        $this->phalconInstance->setFormatter($formatter);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getFormatter()
    {
        return $this->phalconInstance->getFormatter();
    }

    /**
     * @inheritDoc
     */
    public function setLogLevel($level)
    {
        $this->phalconInstance->setLogLevel($level);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLogLevel()
    {
        return $this->phalconInstance->getLogLevel();
    }

    /**
     * @inheritDoc
     */
    public function begin()
    {
        $this->phalconInstance->begin();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function commit()
    {
        $this->phalconInstance->commit();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function rollback()
    {
        $this->phalconInstance->rollback();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        $this->phalconInstance->close();

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function emergency($message, array $context = [])
    {
        $this->phalconInstance->emergency($message, $context);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function alert($message, array $context = [])
    {
        $this->phalconInstance->alert($message, $context);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function critical($message, array $context = [])
    {
        return $this->emergency($message, $context);
    }

    /**
     * @inheritDoc
     */
    public function error($message, array $context = [])
    {
        $this->phalconInstance->error($message, $context);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function warning($message, array $context = [])
    {
        $this->phalconInstance->warning($message, $context);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function notice($message, array $context = [])
    {
        $this->phalconInstance->notice($message, $context);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function info($message, array $context = [])
    {
        $this->phalconInstance->info($message, $context);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function debug($message, array $context = [])
    {
        $this->phalconInstance->debug($message, $context);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function log($level, $message = null, array $context = [])
    {
        $this->phalconInstance->log($level, $message, $context);

        return $this;
    }
}