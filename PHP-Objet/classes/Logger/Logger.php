<?php


namespace App\Logger;


use App\Writer\FileWriter;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class Logger implements LoggerInterface
{
    use LoggerTrait;

    protected $fileWriter;

    public function __construct()
    {
        $this->fileWriter = new FileWriter('app.log', 'a');
    }

    public function log($level, $message, array $context = array())
    {
        $this->fileWriter->write("[$level] $message");
    }
}