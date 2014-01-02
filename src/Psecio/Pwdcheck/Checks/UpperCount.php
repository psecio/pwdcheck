<?php

namespace Psecio\Pwdcheck\Checks;

class UpperCount extends \Psecio\Pwdcheck\Check
{
    public function evaluate($passwordData)
    {
        preg_match_all('/[A-Z]{1}/', $passwordData['raw'], $matches);

        if (isset($matches[0])) {
            // if there's only one, be sure it's not our password
            if (implode('', $matches[0]) == $passwordData['raw']) {
                return 0;
            }
            // otherwise, give credit for each one
            return (strlen($passwordData['raw']) - count($matches[0])) * 2;
        }
        return 0;
    }
}