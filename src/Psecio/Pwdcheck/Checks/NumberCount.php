<?php

namespace Psecio\Pwdcheck\Checks;

class NumberCount extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
        preg_match_all('/[0-9]{1}/', $passwordData['raw'], $matches);

        if (isset($matches[0])) {
            // if there's only one, be sure it's not our password
            if (implode('', $matches[0]) == $passwordData['raw']) {
                return 0;
            }
            // otherwise, give credit for each one
            return count($matches[0]) * 4;
        }
        return 0;
    }
}