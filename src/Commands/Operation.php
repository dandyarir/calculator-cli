<?php
namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Output\OutputInterface;


class Operation extends SymfonyCommand
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isOnlyOneArgument(array $numbers)
    {
        return count($numbers) == 1;
    }

    protected function manualArgumentsValidation(array $numbers, OutputInterface $output)
    {
        if($this->isOnlyOneArgument($numbers)) return $output->writeln($numbers);
        return false;
    }

    public function getOperationHistory($sign, array $arr)
    {
        return implode($sign, $arr);
    }

    public function getOutput($message, $result)
    {
        return $message.' = '.$result;
    }
}
