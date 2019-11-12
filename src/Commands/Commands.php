<?php
namespace Calculator;


use Jakmall\Recruitment\Calculator\Commands\AddOperation;

class Commands
{
    public function __construct()
    {
        return [
            new AddOperation()
        ];
    }
}
