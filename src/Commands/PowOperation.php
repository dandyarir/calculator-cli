<?php
namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class PowOperation extends Operation
{
    public function configure()
    {
        $this->setName('pow')
            ->setDescription('Exponent the given Number')
            ->setHelp('This command allows you to exponent the Number you given')
            ->addArgument('base', InputArgument::REQUIRED, 'The base number')
            ->addArgument('exp', InputArgument::REQUIRED, 'The exponent number');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->powNumbers($input, $output);
    }

    /**
     * @param InputInterface $numbers
     * @param OutputInterface $output
     * @return mixed
     */
    public function powNumbers(InputInterface $numbers, OutputInterface $output)
    {
        $args = $numbers->getArguments();

        $base = $args['base'];
        $exp = $args['exp'];

        list($result, $resulView) = $this->mathOperation($base, $exp);

        $operationHistory = $this->getOperationHistory(' ^ ', $resulView);

        $this->closingProcess(
            $this->getName(),
            date('Y-m-d H:i:s'),
            $operationHistory,
            $result,
            $this->getOutput($operationHistory, $result),
            $output
        );
    }

    public function mathOperation($base, $exponent)
    {
        $arrValues = [$base, $exponent];
        return [pow($base, $exponent), $arrValues];
    }
}
