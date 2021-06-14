<?php

namespace Diarium\To\Anything\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Cli implements LoggerInterface
{

    public function emergency($message, array $context = array()) {
        $codes = array(33, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = array()) {
        $codes = array(33, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = array()) {
        $codes = array(31, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = array()) {
        $codes = array(31, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = array()) {
        $codes = array(33, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = array()) {
        $codes = array(33, 40);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = array()) {
        $codes = array(0, 32);
        $message = "\033[".implode(';', $codes).'m'.$message."\033[0m";
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = array()) {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    /**
     * @todo implement placeholders described in LoggerInterface
     */
    public function log($level, $message, array $context = array()) {
        // TODO $context
        printf("[%s] %s: %s\n", date('d-m-Y H:i:s'), ucfirst($level), $message);
    }

}
