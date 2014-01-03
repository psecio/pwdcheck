<?php

namespace Psecio\Pwdcheck\Checks;

class SeqCharacter extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
    	$found = 0;
    	preg_match_all('/[a-zA-Z]{2,}/', $passwordData['raw'], $matches);

    	if (isset($matches[0])) {
    		foreach ($matches[0] as $match) {

    			$parts = str_split($match);
    			for ($i=0; $i<count($parts); $i++) {
    				// see if we have a "next"
    				if (!isset($parts[$i+1])) {
    					continue;
    				}
    				$current = ord($parts[$i]);
    				$next = ord($parts[$i+1]);

    				if ($next == ($current + 1) || $next == ($current - 1)) {
    					$found -= 1;
    				}
    			}
    		}
    		return ($found + 1) * 2;
    	}
        return 0;
    }
}