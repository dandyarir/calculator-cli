<?php
namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class MultiplyOperation extends Operation
{
    public function configure()
    {
        $this->setName('multiply')
            ->setDescription('Multiply all given Numbers')
            ->setHelp('Multiply <numbers>...')
            ->addArgument('numbers', InputArgument::IS_ARRAY, 'The numbers to be multiplied');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->multiplyNumbers($input, $output);
    }

    /**
     * @param InputInterface $numbers
     * @param OutputInterface $output
     * @return mixed
     */
    public function multiplyNumbers(InputInterface $numbers, OutputInterface $output)
    {
        $numbers = $numbers->getArguments()['numbers'];

        $validation = $this->manualArgumentsValidation($numbers);
        if ($validation) {
            $output->write($validation);
            return false;
        }
        list($result, $resultView) = $this->mathOperation($numbers);

        $operationHistory = $this->getOperationHistory(' * ', $resultView);

        $this->closingProcess(
            $this->getName(),
            date('Y-m-d H:i:s'),
            $operationHistory,
            $result,
            $this->getOutput($operationHistory, $result),
            $output
        );
    }

    private function mathOperation(array $numbers)
    {
        $result = $numbers[0];
        $resultView = [$result];
        foreach ($numbers as $number) {
            $result *= $number;
            array_push($resultView, $number);
        }

        return [$result, $resultView];
    }


}
