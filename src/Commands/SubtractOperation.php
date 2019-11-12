<?php
namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class SubtractOperation extends Operation
{
    public function configure()
    {
        $this->setName('subtract')
            ->setDescription('subtract all given Numbers')
            ->setHelp('Subtract <numbers>...')
            ->addArgument('numbers', InputArgument::IS_ARRAY, 'The numbers to be subtracted');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->subtractNumbers($input, $output);
    }

    /**
     * @param InputInterface $numbers
     * @param OutputInterface $output
     * @return mixed
     */
    public function subtractNumbers(InputInterface $numbers, OutputInterface $output)
    {
        $numbers = $numbers->getArguments()['numbers'];

        $this->manualArgumentsValidation($numbers, $output);

        list($result, $resultView) = $this->mathOperation($numbers);

        $operationHistory = $this->getOperationHistory(' - ', $resultView);

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
            $result -= $number;
            array_push($resultView, $number);
        }

        return [$result, $resultView];
    }


}
