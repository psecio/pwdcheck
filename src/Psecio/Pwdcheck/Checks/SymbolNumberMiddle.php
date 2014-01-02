<?php

namespace Psecio\Pwdcheck\Checks;

class SymbolNumberMiddle extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
        // the Wolfram version only really accounts for numbers
        $password = substr($passwordData['raw'], 1, strlen($passwordData['raw']) - 2);
        preg_match_all('/[0-9]{1}/', $password, $matches);

        return (isset($matches[0])) ? count($matches[0]) * 2 : 0;
    }
}