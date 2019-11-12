<?php
namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class DivideOperation extends Operation
{
    public function configure()
    {
        $this->setName('divide')
            ->setDescription('Divide all given Numbers')
            ->setHelp('Multiply <numbers>...')
            ->addArgument('numbers', InputArgument::IS_ARRAY, 'The numbers to be divided');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->divideNumbers($input, $output);
    }

    /**
     * @param InputInterface $numbers
     * @param OutputInterface $output
     * @return mixed
     */
    public function divideNumbers(InputInterface $numbers, OutputInterface $output)
    {
        $numbers = $numbers->getArguments()['numbers'];

        $this->manualArgumentsValidation($numbers, $output);

        list($result, $resultView) = $this->mathOperation($numbers, $output);

        if ($result == null) return false; //if there is found zero as divisor

        $operationHistory = $this->getOperationHistory(' / ', $resultView);

        $this->closingProcess(
            $this->getName(),
            date('Y-m-d H:i:s'),
            $operationHistory,
            $result,
            $this->getOutput($operationHistory, $result),
            $output
        );
    }

    private function mathOperation(array $numbers, OutputInterface $output)
    {
        $result = $numbers[0];
        $resultView = [$result];
        for ($i = 1; $i < count($numbers); ++$i) {
            if ($numbers[$i] == 0) return $output->write("infinity");
            $result /= $numbers[$i];
            array_push($resultView, $numbers[$i]);
        }

        return [$result, $resultView];
    }


}
