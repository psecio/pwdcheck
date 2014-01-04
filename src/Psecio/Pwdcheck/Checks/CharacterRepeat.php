<?php

namespace Psecio\Pwdcheck\Checks;

class CharacterRepeat extends \Psecio\Pwdcheck\Check
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
        $result = 0;

        foreach ($passwordData['list'] as $character => $count) {
            if ($count > 1) {
                $score += $count - 1;
            }
        }
        if ($score > 0) {
            $result -= (int)($score / (strlen($passwordData['raw']) - $score)) + 1;
        }
        return $result;
    }
}