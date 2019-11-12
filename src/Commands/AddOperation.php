<?php
namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class AddOperation extends Operation
{
    public function configure()
    {
        $this->setName('add')
            ->setDescription('Add all given Numbers')
            ->setHelp('Add <numbers>...')
            ->addArgument('numbers', InputArgument::IS_ARRAY, 'The Numbers to be added');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->addNumbers($input, $output);
    }

    /**
     * @param InputInterface $numbers
     * @param OutputInterface $output
     * @return mixed
     */
    public function addNumbers(InputInterface $numbers, OutputInterface $output)
    {
        $numbers = $numbers->getArguments()['numbers'];

        $this->manualArgumentsValidation($numbers, $output);

        list($result, $resultView) = $this->mathOperation($numbers);

        $operationHistory = $this->getOperationHistory(' + ', $resultView);

        $this->getOutput($operationHistory, $result);

    }

    private function mathOperation(array $numbers)
    {
        $result = 0;
        $resultView = [];
        foreach ($numbers as $number) {
            $result += $number;
            array_push($resultView, $number);
        }

        return [$result, $resultView];
    }


}
