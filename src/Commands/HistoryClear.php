<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HistoryClear extends History
{
    protected function configure()
    {
        $this->setName('history:clear')
            ->setDescription('Clear saved history');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (file_exists($this->logs)) {
            unlink($this->logs);
            $output->writeln("History cleared successfully");
        } else {
            $output->writeln("History is empty nothing to be cleared");
        }
    }
}
