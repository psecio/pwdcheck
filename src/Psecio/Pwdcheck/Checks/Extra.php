<?php

namespace Psecio\Pwdcheck\Checks;

class Extra extends \Psecio\Pwdcheck\Check
{
    /**
     * Execute the check using the given password data
     * 
     * @param array $passwordData Formatted password data
     * @return integer Resulting score
     */
    public function evaluate($passwordData)
    {
    	$score = 0;

    	// at least 8 characters
        if (strlen($passwordData['raw']) >= 8) {
        	$score += 2;
        }

        // contains at least three of lower, upper, numbers, special chars
        foreach (array('upper', 'lower', 'number', 'symbol') as $type) {
        	if ($passwordData[$type]['count'] > 0) {
        		$score += 2;
        	}	
        }

        return $score;
    }
}