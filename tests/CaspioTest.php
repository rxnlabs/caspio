<?php

use Caspio\Caspio as Caspio;

class CaspioTest extends PHPUnit_Framework_TestCase
{
    public function providerHTTPInterface()
    {
        return array(
            array('\Caspio\HTTP\Httpful')
            );
    }

    public function testAccessTokenString()
    {
        $access_token = '0123456789';
        $caspio = new Caspio($access_token);
        $this->assertSame($access_token, $caspio->access_token, 'The access token is not the same type and value');
    }

    /**
     * @param string the HTTP Client interface used to make the request
     * 
     * @dataProvider providerHTTPInterface
     */
    public function tesHTTPAdapterGetRequest($interface)
    {
        $class = new ReflectionClass($interface);
        $adapter = $class->newInstanceWithoutConstructor();
        $access_token = '0123456789';
        $caspio = new Caspio($access_token);
        $caspio->setHTTPAdapter($adapter);
        $request_params = array('url'=>'https://www.yahoo.com', 'header'=>array('foo'=>'bar'));
        $request = $caspio->getHTTPAdapter()->getRequest($request_params);
        $this->assertInstanceOf('stdClass', $request, 'Passing the HTTP interface and making a request to yahoo.com did not return an object');
    }

    /**
     * @param string the HTTP Client interface used to make the request
     * 
     * @dataProvider providerHTTPInterface
     */
    public function tesHTTPAdapterPostRequest($interface)
    {
        $class = new ReflectionClass($interface);
        $adapter = $class->newInstanceWithoutConstructor();
        $access_token = '0123456789';
        $caspio = new Caspio($access_token);
        $caspio->setHTTPAdapter($adapter);
        $request_params = array('url'=>'https://www.yahoo.com', 'header'=>array('foo'=>'bar'));
        $request = $caspio->getHTTPAdapter()->getRequest($request_params);
        $this->assertInstanceOf('stdClass', $request, 'Passing the HTTP interface and making a request to yahoo.com did not return an object');
    }

    /**
     * @param string the HTTP Client interface used to make the request
     * 
     * @dataProvider providerHTTPInterface
     */
    public function tesHTTPAdapterPutRequest($interface)
    {
        $class = new ReflectionClass($interface);
        $adapter = $class->newInstanceWithoutConstructor();
        $access_token = '0123456789';
        $caspio = new Caspio($access_token);
        $caspio->setHTTPAdapter($adapter);
        $request_params = array('url'=>'https://www.yahoo.com', 'header'=>array('foo'=>'bar'));
        $request = $caspio->getHTTPAdapter()->putRequest($request_params);
        $this->assertInstanceOf('stdClass', $request, 'Passing the HTTP interface and making a request to yahoo.com did not return an object');
    }

    /**
     * @param string the HTTP Client interface used to make the request
     * 
     * @dataProvider providerHTTPInterface
     */
    public function tesHTTPAdapterDeleteRequest($interface)
    {
        $class = new ReflectionClass($interface);
        $adapter = $class->newInstanceWithoutConstructor();
        $access_token = '0123456789';
        $caspio = new Caspio($access_token);
        $caspio->setHTTPAdapter($adapter);
        $request_params = array('url'=>'https://www.yahoo.com', 'header'=>array('foo'=>'bar'));
        $request = $caspio->getHTTPAdapter()->deleteRequest($request_params);
        $this->assertInstanceOf('stdClass', $request, 'Passing the HTTP interface and making a request to yahoo.com did not return an object');
    }
}