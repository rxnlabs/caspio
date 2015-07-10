<?php

class HttpfulTest extends PHPUnit_Framework_TestCase
{
    public function testAdapterExists()
    {
        $adapter = new Caspio\HTTP\Httpful;
        $this->assertTrue($adapter->classExists(), 'Httpful http client exists');
    }

    /**
     * @expectedException Httpful\Exception\ConnectionErrorException
     */
    public function testConnectionException()
    {
        throw new Httpful\Exception\ConnectionErrorException;
    }

    public function testGetRequestPass()
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>'http://yahoo.com', 'headers'=>array('foo'=>'bar'));
        $request = $adapter->getRequest($request_params);
        $this->assertInstanceOf('Httpful\Response', $request, 'Request successful');
    }

    /**
     * @expectedException Httpful\Exception\ConnectionErrorException
     */
    public function testGetRequestFail()
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>'http://thisisamadeupurlthing.com', 'headers'=>array('foo'=>'bar'));
        $request = $adapter->getRequest($request_params);
        $this->assertInstanceOf('Httpful\Exception\ConnectionErrorException', $request, 'Could not connect to non-existent URL');
    }
}