<?php

namespace Psecio\Pwdcheck;

class PasswordTest extends \PHPUnit_Framework_TestCase
{
    private $password;

    public function setUp()
    {
        $this->password = new Password();
    }

    /**
     * Test an alpha-only string
     *
     * @covers \Psecio\Pwdcheck\Password::parse
     */
    public function testParsePasswordAlpha()
    {
        $password = 'abcdEFg';
        $result = $this->password->parse($password);

        $this->assertEquals(5, $result['lower']['count']);
        $this->assertEquals(2, $result['upper']['count']);
    }

    /**
     * Test an numeric-only string
     *
     * @covers \Psecio\Pwdcheck\Password::parse
     */
    public function testParsePasswordNumeric()
    {
        $password = '1234567';
        $result = $this->password->parse($password);

        $this->assertEquals(7, $result['number']['count']);
    }

    /**
     * Test an alphanumeric-only string
     *
     * @covers \Psecio\Pwdcheck\Password::parse
     */
    public function testParsePasswordAlphaNum()
    {
        $password = 'abc123';
        $result = $this->password->parse($password);

        $this->assertEquals(3, $result['lower']['count']);
        $this->assertEquals(3, $result['number']['count']);
    }

    /**
     * Test an symbol-only string
     *
     * @covers \Psecio\Pwdcheck\Password::parse
     */
    public function testParsePasswordSymbol()
    {
        $password = '!@#$%^';
        $result = $this->password->parse($password);

        $this->assertEquals(6, $result['symbol']['count']);
    }

    /**
     * Test a complex string - alpha, numeric & symbol
     *
     * @covers \Psecio\Pwdcheck\Password::parse
     */
    public function testParsePasswordAlphanumSymbol()
    {
        $password = 'ab#@ABC14*&';
        $result = $this->password->parse($password);

        $this->assertEquals(2, $result['lower']['count']);
        $this->assertEquals(3, $result['upper']['count']);
        $this->assertEquals(4, $result['symbol']['count']);
    }

    /**
     * Test setting for the "raw" value
     *
     * @covers \Psecio\Pwdcheck\Password::parse
     */
    public function testParsePasswordSetRaw()
    {
        $password = 'abc123';
        $result = $this->password->parse($password);

        $this->assertEquals($password, $result['raw']);
    }

    /**
     * Test the setting of the "length" value
     *
     * @covers \Psecio\Pwdcheck\Password::parse
     */
    public function testParsePasswordSetLength()
    {
        $password = 'abc123';
        $result = $this->password->parse($password);

        $this->assertEquals(6, $result['length']);
    }
}