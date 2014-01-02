<?php

namespace Psecio\Pwdcheck\Checks;

class SymbolCount extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
        return ($passwordData['symbol']['count'] * 6);
    }
}