Pwdcheck : A password strength checker
=====================

[![Packagist Version](https://img.shields.io/packagist/v/psecio/pwdcheck.svg?style=flat-square)](https://packagist.org/packages/psecio/pwdcheck)
[![Build Status](https://img.shields.io/travis/psecio/pwdcheck/master.svg?style=flat-square)](https://travis-ci.org/psecio/pwdcheck)

The `Pwdcheck` tool uses the Wolfram Alpha method for estimating the strength of a password.
It goes through a set of several checks to give the password a "score":

- 0-60: Very Weak
- 60-70: Weak
- 70-80: Fair
- 80-90: Strong
- 90-100: Very Strong

#### Installation

You can use Composer to install `Pwdcheck`:

```
{
	"require": {
		"psecio/pwdcheck": "1.*"
	}
}
```

#### Usage

Usage of the tool is simple and you can either fetch the text version of the strength (ex. "Very Weak") or a 
numeric representation from zero through four:

```php
<?php
require_once 'vendor/autoload.php';

$p = new \Psecio\Pwdcheck\Password();
$p->evaluate($password);

// getting the numeric representation:
echo 'Strength: '.$p->getStrength()."\n";

// getting the text version:
echo 'Strength: '.$p->getStrength(true)."\n";

// you can also get the raw score either as a return value or using getScore
$result = $p->evaluate($password);
echo 'Score: '.$result."\n"

echo 'Score: '.$p->getScore()."\n";

```
