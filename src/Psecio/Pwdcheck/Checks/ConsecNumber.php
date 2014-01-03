<?php

namespace Psecio\Pwdcheck\Checks;

class ConsecNumber extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
		preg_match_all('/[0-9]{2,}/', $passwordData['raw'], $matches);
    	if (!empty($matches[0])) {
    		$score = 0;
    		foreach ($matches[0] as $match) {
    			$score -= (strlen($match) - 1) * 2;
    		}
    		return $score;
    	}
        return 0;
    }
}