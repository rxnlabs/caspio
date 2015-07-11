<?php

class HttpfulTest extends PHPUnit_Framework_TestCase
{
    public function providerTestURLRequestPass()
    {
        return array(
            array('https://www.yahoo.com'),
            array('https://www.google.com'),
            array('https://www.wikipedia.org'),
            array('https://wordpress.com')
            );
    }

    public function providerTestURLRequestFail()
    {
        return array(
            array('http://thisisamadeupurlthing.com'),
            array('http://this-is-a-madeup-url-thing.com'),
            array('http://thisisamadeup.urlthing.com'),
            array('http://this-is-a-madeup.urlthing.com')
            );
    }

    public function testAdapterExist()
    {
        $adapter = new Caspio\HTTP\Httpful;
        $this->assertTrue($adapter->classExists(), 'Httpful library exists');
    }

    public function testAdapterExistFail()
    {
        $adapter = new Caspio\HTTP\Httpful;
        $this->assertTrue($adapter->classExists(), 'Httpful library exists');
    }

    /**
     * @expectedException Httpful\Exception\ConnectionErrorException
     */
    public function testConnectionException()
    {
        throw new Httpful\Exception\ConnectionErrorException;
    }

    /**
     * @param string URL to test the request method
     * 
     * @dataProvider providerTestURLRequestPass
     */
    public function testGetRequestPass($url)
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>$url, 'headers'=>array('foo'=>'bar'));
        $request = $adapter->getRequest($request_params);
        $message = sprintf('Request to %s not successful', $url);
        $message2 = sprintf('Request to %1$s did not return an instance of class %2$s', $url, '\Httpful\Response');
        $this->assertInstanceOf('stdClass', $request, $message);
        $this->assertInstanceOf('\Httpful\Response', $request->adapter, $message2);
    }

    /**
     * @param string URL to test the request method
     * 
     * @dataProvider providerTestURLRequestFail
     * @expectedException Httpful\Exception\ConnectionErrorException
     */
    public function testGetRequestFail($url)
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>$url, 'headers'=>array('foo'=>'bar'));
        $request = $adapter->getRequest($request_params);
        $message = sprintf('Able to connect to %s, change the fake URL to something different', $url);
        $this->assertInstanceOf('Httpful\Exception\ConnectionErrorException', $request, $message);
    }

    /**
     * @param string URL to test the request method
     * 
     * @dataProvider providerTestURLRequestPass
     */
    public function testPostRequestPass($url)
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>$url, 'headers'=>array('foo'=>'bar'));
        $request = $adapter->postRequest($request_params);
        $message = sprintf('Request to %s not successful', $url);
        $message2 = sprintf('Request to %1$s did not return an instance of class %2$s', $url, '\Httpful\Response');
        $this->assertInstanceOf('stdClass', $request, $message);
        $this->assertInstanceOf('\Httpful\Response', $request->adapter, $message2);
    }

    /**
     * @param string URL to test the request method
     * 
     * @dataProvider providerTestURLRequestFail
     * @expectedException Httpful\Exception\ConnectionErrorException
     */
    public function testPostRequestFail($url)
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>$url, 'headers'=>array('foo'=>'bar'));
        $request = $adapter->postRequest($request_params);
        $message = sprintf('Able to connect to %s, change the fake URL to something different', $url);
        $this->assertInstanceOf('Httpful\Exception\ConnectionErrorException', $request, $message);
    }

    /**
     * @param string URL to test the request method
     * 
     * @dataProvider providerTestURLRequestPass
     */
    public function testPutRequestPass($url)
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>$url, 'headers'=>array('foo'=>'bar'));
        $request = $adapter->putRequest($request_params);
        $message = sprintf('Request to %s not successful', $url);
        $message2 = sprintf('Request to %1$s did not return an instance of class %2$s', $url, '\Httpful\Response');
        $this->assertInstanceOf('stdClass', $request, $message);
        $this->assertInstanceOf('\Httpful\Response', $request->adapter, $message2);
    }

    /**
     * @param string URL to test the request method
     * 
     * @dataProvider providerTestURLRequestFail
     * @expectedException Httpful\Exception\ConnectionErrorException
     */
    public function testPutRequestFail($url)
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>$url, 'headers'=>array('foo'=>'bar'));
        $request = $adapter->putRequest($request_params);
        $message = sprintf('Able to connect to %s, change the fake URL to something different', $url);
        $this->assertInstanceOf('Httpful\Exception\ConnectionErrorException', $request, $message);
    }

    /**
     * @param string URL to test the request method
     * 
     * @dataProvider providerTestURLRequestPass
     */
    public function testDeleteRequestPass($url)
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>'https://www.yahoo.com', 'headers'=>array('foo'=>'bar'));
        $request = $adapter->deleteRequest($request_params);
        $message = sprintf('Request to %s not successful', $url);
        $message2 = sprintf('Request to %1$s did not return an instance of class %2$s', $url, '\Httpful\Response');
        $this->assertInstanceOf('stdClass', $request, $message);
        $this->assertInstanceOf('\Httpful\Response', $request->adapter, $message2);
    }

    /**
     * @param string URL to test the request method
     * 
     * @dataProvider providerTestURLRequestFail
     * @expectedException Httpful\Exception\ConnectionErrorException
     */
    public function testDeleteRequestFail($url)
    {
        $adapter = new Caspio\HTTP\Httpful;
        $request_params = array('url'=>$url, 'headers'=>array('foo'=>'bar'));
        $request = $adapter->deleteRequest($request_params);
        $message = sprintf('Able to connect to %s, change the fake URL to something different', $url);
        $this->assertInstanceOf('Httpful\Exception\ConnectionErrorException', $request, $message);
    }

}