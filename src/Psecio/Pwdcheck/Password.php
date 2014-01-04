<?php

namespace Psecio\Pwdcheck;

class Password
{
    /**
     * Current password's total score
     * @var integer
     */
    private $score = 0;

    /**
     * Constants defining the return values for 
     * strength ratings
     */
    const STRENGTH_VERY_WEAK = 0;
    const STRENGTH_WEAK = 1;
    const STRENGTH_FAIR = 2;
    const STRENGTH_STRONG = 3;
    const STRENGTH_VERY_STRONG = 4;

    /**
     * List of tests in the order to process
     * Does not include dictionary check
     *
     * @var array
     */
    private $testOrder = array(
        'length', 'upperCount', 'lowerCount', 'numberCount',
        'symbolCount', 'symbolNumberMiddle', 'charactersOnly', 'numberOnly',
        'characterRepeat', 'consecUpper', 'consecLower', 'consecNumber',
        'seqNumber', 'seqCharacter', 'extra'
    );

    /**
     * Get the current password strength
     *     Either numeric or as plain text
     * 
     * @param boolean $asText Flag to return either integer or text
     * @return mixed Either integer or string repreesnting strength
     */
    public function getStrength($asText = false)
    {
        $score = $this->getScore();

        if ($score <= 60) {
            return ($asText) ? 'Very Weak' : self::STRENGTH_VERY_WEAK;
        } elseif ($score > 60 && $score <= 70) {
            return ($asText) ? 'Weak' : self::STRENGTH_WEAK;
        } elseif ($score > 70 && $score <= 80) {
            return ($asText) ? 'Fair' : self::STRENGTH_FAIR;
        } elseif ($score > 80 && $score <= 90) {
            return ($asText) ? 'Strong' : self::STRENGTH_STRONG;
        } else {
            return ($asText) ? 'Very Strong' : self::STRENGTH_VERY_STRONG;
        }
    }

    /**
     * Evaluate the given password string
     * 
     * @param string $password Password to evaluate
     * @return integer Resulting score
     */
    public function evaluate($password)
    {
        $passwordData = $this->parse($password);
        $score = $this->getScore();

        foreach ($this->testOrder as $testName) {
            $className = "\\Psecio\\Pwdcheck\\Checks\\".ucwords($testName);
            if (class_exists($className)) {
                $test = new $className();
                $result = $test->evaluate($passwordData);
                $score += $result;
            }
        }
        $this->setScore($score);
        return $score;
    }

    /**
     * Parse the password into relevant data
     * 
     * @param string $password Password to evaluate
     * @return array Parsed password data
     */
    public function parse($password)
    {
        $passwordData = array(
            'number' => array(
                'count' => 0
            ),
            'upper' => array(
                'count' => 0
            ),
            'lower' => array(
                'count' => 0
            ),
            'symbol' => array(
                'count' => 0,
                'list' => array()
            ),
            'list' => array(),
            'length' => 0,
            'raw' => trim($password)
        );
        $passwordData['length'] = strlen($password);

        for ($i=0; $i < strlen($password); $i++) {
            $character = $password[$i];
            $code = ord($character);

            if ($code >= 48 && $code <= 57) {
                $passwordData['number']['count']++;
            } else if ($code >= 65 && $code <= 90) {
                $passwordData['upper']['count']++;
            } else if ($code >= 97 && $code <= 122) {
                $passwordData['lower']['count']++;
            } else {
                $passwordData['symbol']['count']++;
                $passwordData['symbol']['list'][] = $character;
            }

            (isset($passwordData['list'][$character]))
                ? $passwordData['list'][$character]++ : $passwordData['list'][$character] = 1;

        }

        return $passwordData;
    }

    /**
     * Get the current score
     * 
     * @return integer Score value
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set the current score
     * 
     * @param integer $score
     */
    public function setScore($score)
    {
        $this->score = $score;
    }
}