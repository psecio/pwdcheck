<?php

namespace Psecio\Pwdcheck;

abstract class Check
{
	/**
	 * Required evaluation function - runs the
	 * 	checking for the rule
	 * 
	 * @param array $passwordData Parsed password data
	 * @return integer Resulting score
	 */
    public abstract function evaluate($passwordData);
}