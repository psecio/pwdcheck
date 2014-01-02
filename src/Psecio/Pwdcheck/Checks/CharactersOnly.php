<?php

namespace Psecio\Pwdcheck\Checks;

class CharactersOnly extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
        $passwordLength = strlen($passwordData['raw']);
        return (
            $passwordData['lower']['count'] + $passwordData['upper']['count'] == $passwordLength
        ) ? -$passwordLength : 0;
    }
}