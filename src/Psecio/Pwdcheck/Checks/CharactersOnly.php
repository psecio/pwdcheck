<?php

namespace Psecio\Pwdcheck\Checks;

class CharactersOnly extends \Psecio\Pwdcheck\Check
{
	/**
     * Execute the check using the given password data
     * 
     * @param array $passwordData Formatted password data
     * @return integer Resulting score
     */
    public function evaluate($passwordData)
    {
        $passwordLength = strlen($passwordData['raw']);
        return (
            $passwordData['lower']['count'] + $passwordData['upper']['count'] == $passwordLength
        ) ? -$passwordLength : 0;
    }
}