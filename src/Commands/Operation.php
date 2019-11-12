<?php
namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Output\OutputInterface;


class Operation extends SymfonyCommand
{
    protected $logs = '_history.csv';

    public function __construct()
    {
        parent::__construct();
    }

    public function isZeroArgument(array $numbers)
    {
        return count($numbers) == 0;
    }

    public function isOnlyOneArgument(array $numbers)
    {
        return count($numbers) == 1;
    }

    protected function manualArgumentsValidation(array $numbers)
    {
        if ($this->isZeroArgument($numbers)) {
            return "Argument cant be empty";
        } elseif ($this->isOnlyOneArgument($numbers)) {
            return $numbers;
        }

        return null;
    }

    public function getOperationHistory($sign, array $arr)
    {
        return implode($sign, $arr);
    }

    public function getOutput($message, $result)
    {
        return $message.' = '.$result;
    }

    public function generateHistory(array $logArrays)
    {
        $logs = fopen($this->logs, (file_exists($this->logs) ? 'a' : 'w'));
        fputcsv($logs, $logArrays);
        fclose($logs);
    }

    public function createHistoryParams($name, $operationView, $result, $operationWithResult, $date)
    {
        return [
            'Command'       => $name,
            'Description'   => $operationView,
            'Result'        => $result,
            'output'        => $operationWithResult,
            'time'          => $date
        ];
    }

    public function closingProcess(
        $operationName,
        $date,
        $operationHistory,
        $result,
        $resultView,
        OutputInterface $output)
    {
        $historyParams = $this->createHistoryParams(
            $operationName,
            $operationHistory,
            $result,
            $resultView,
            $date
        );

        $this->generateHistory($historyParams);

        return $output->writeln($resultView);
    }
}
