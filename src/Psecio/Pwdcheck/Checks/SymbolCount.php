<?php

namespace Psecio\Pwdcheck\Checks;

class SymbolCount extends \Psecio\Pwdcheck\Check
{
	/**
     * Execute the check using the given password data
     * 
     * @param array $passwordData Formatted password data
     * @return integer Resulting score
     */
    public function evaluate($passwordData)
    {
        return ($passwordData['symbol']['count'] * 6);
    }
}