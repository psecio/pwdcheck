<?php

namespace Psecio\Pwdcheck;

class Password
{
    private $score = 0;

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

    public function evaluate($password)
    {
        $passwordData = $this->parse($password);
        $score = $this->getScore();

        foreach ($this->testOrder as $testName) {
            $className = "\\Psecio\\Pwdcheck\\Checks\\".ucwords($testName);
            if (class_exists($className)) {
                $test = new $className();
                $result = $test->evaluate($passwordData);
                echo $testName.' - '.$result."\n";

                $score += $result;
            }
        }

        echo "\n\n".'SCORE: '.$score."\n";

        return $this->getScore();
    }

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

    public function getScore()
    {
        return $this->score;
    }
    public function setScore($score)
    {
        $this->score = $score;
    }
}