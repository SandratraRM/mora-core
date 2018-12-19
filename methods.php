<?php

use Mora\Core\cli\Console\Output;
use Mora\Core\cli\Console\CliStrings;

function ask($key)
{
    Output::printRequest(CliStrings::get($key));
    return trim(fgets(STDIN));
}