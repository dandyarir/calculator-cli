<?php

use Jakmall\Recruitment\Calculator\Commands\AddOperation;
use Jakmall\Recruitment\Calculator\Commands\DivideOperation;
use Jakmall\Recruitment\Calculator\Commands\MultiplyOperation;
use Jakmall\Recruitment\Calculator\Commands\PowOperation;
use Jakmall\Recruitment\Calculator\Commands\SubtractOperation;

return [
    new AddOperation(),
    new SubtractOperation(),
    new MultiplyOperation(),
    new DivideOperation(),
    new PowOperation()
];
