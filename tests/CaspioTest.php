<?php

use Caspio\Caspio as Caspio;

class CaspioTest extends PHPUnit_Framework_TestCase
{
    public function testAccessTokenString()
    {
        $access_token = '0123456789';
        $caspio = new Caspio($access_token);
        $this->assertSame('0123456789', $caspio->access_token, 'The access token is not the same type and value');
    }
}