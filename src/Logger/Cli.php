<?php

namespace Diarium\To\Anything\Logger;

use Psr\Log\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Cli implements LoggerInterface
{

    private $acceptedLevels = [
        LogLevel::ALERT, LogLevel::CRITICAL, LogLevel::DEBUG,
        LogLevel::EMERGENCY, LogLevel::ERROR, LogLevel::INFO,
        LogLevel::NOTICE, LogLevel::WARNING,
    ];

    /**
     * System is unusable.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function emergency($message, array $context = array()) {
        $codes = array(33, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function alert($message, array $context = array()) {
        $codes = array(31, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function critical($message, array $context = array()) {
        $codes = array(31, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function error($message, array $context = array()) {
        $codes = array(31, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     *
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function warning($message, array $context = array()) {
        $codes = array(33, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function notice($message, array $context = array()) {
        $codes = array(33, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     *
     * Example: User logs in, SQL logs.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function info($message, array $context = array()) {
        $codes = array(0, 32);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string  $message
     * @param mixed[] $context
     *
     * @return void
     */
    public function debug($message, array $context = array()) {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * @todo implement placeholders described in LoggerInterface
     */
    public function log($level, $message, array $context = array()) {
        if (! in_array($level, $this->acceptedLevels, true)) {
            throw new InvalidArgumentException('invalid level: ' . $level);
        }
        $message = $this->interpolate($message, $context);
        printf("[%s] %s: %s\n", date('d-m-Y H:i:s'), ucfirst($level), $message);
    }

    /**
     * Interpolates context values into the message placeholders.
     */
    private static function interpolate($message, array $context = array())
    {
        $replace = array();
        foreach ($context as $key => $val) {
            // check that the value can be cast to string
            if (!is_array($val) && (!is_object($val) || method_exists($val, '__toString'))) {
                $replace['{' . $key . '}'] = $val;
            }
        }

        return strtr($message, $replace);
    }
}
