<?php

namespace Psecio\Pwdcheck;

abstract class Check
{
    public abstract function evaluate($passwordData);
}