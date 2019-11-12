<?php
namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SubtractOperation extends Operation
{
    public function configure()
    {
        $this->setName('multiply')
            ->setDescription('Multiply all given Numbers')
            ->setHelp('Multiply <numbers>...')
            ->addArgument('numbers', InputArgument::IS_ARRAY, 'multiply all given Numbers');
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

        $this->manualArgumentsValidation($numbers, $output);

        list($result, $resultView) = $this->mathOperation($numbers);

        $operationHistory = $this->getOperationHistory(' * ', $resultView);

        $this->getOutput($operationHistory, $result);

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
