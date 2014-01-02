<?php

namespace Psecio\Pwdcheck\Checks;

class NumberOnly extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
        $passwordLength = strlen($passwordData['raw']);
        return (
            $passwordData['number']['count'] == $passwordLength
        ) ? -$passwordLength : 0;
    }
}