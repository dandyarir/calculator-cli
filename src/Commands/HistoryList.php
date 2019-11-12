<?php


namespace Jakmall\Recruitment\Calculator\Commands;


use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HistoryList extends History
{
    protected function configure()
    {
        $this->setName('history:list')
            ->setDescription('Show calculator history')
            ->addArgument('commands', InputArgument::IS_ARRAY,'Filter the history by commands');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $row = 1;

        if (file_exists($this->logs) && ($handle = fopen($this->logs, "r")) !== FALSE) {
            $table = new Table($output);
            $table->setHeaders(['No', 'Command', 'Description', 'Result', 'Output', 'Time']);
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $datum = [];
                array_push($datum, $row);
                for ($c = 0; $c < $num; ++$c) {
                    array_push($datum, $data[$c]);
                }
                $table->addRow($datum);
                $row++;
            }
            $table->render();
            fclose($handle);
        } else {
            $output->writeln('History is empty');
        }
    }
}
