<?php

namespace Psecio\Pwdcheck\Checks;

class Length extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
        return ($passwordData['length']*4);
    }
}