<?php

namespace Caspio\HTTP;

class Httpful implements HTTPInterface
{   

    public $instance;
    /**
     * Verify the Httpful class is loaded
     * 
     * @return bool True if class exist or Exception if the class does not exist
     */
    public function classExists()
    {
        $exist = class_exists('\Httpful\Httpful');

        if ($exist === false) {
            throw new AdapterErrorException('Cannot find the class Httpful in the namespace Httpful. Please make sure this class is loaded before using this adapter.');
        }

        return true;
    }

    public function getRequest(array $request_params)
    {
        $this->classExists();

        if (!array_key_exists('url', $request_params)) {

        }

        if (!array_key_exists('headers', $request_params)) {

        }

        extract($request_params);

        $request = \Httpful\Request::get($url)
            ->addHeaders($headers)
            ->send();

        return $request;
    }

    public function postRequest(array $request_params)
    {
        $this->classExists();
        
        if (!array_key_exists('url', $request_params)) {

        }

        if (!array_key_exists('headers', $request_params)) {

        }

        extract($request_params);

        if (array_key_exists('body', $request_params)) {
            $request = \Httpful\Request::post($url)
                ->addHeaders($headers)
                ->body($body)
                ->send();
        } else {
            $request = \Httpful\Request::post($url)
                ->addHeaders($headers)
                ->send();
        }
    }

    public function putRequest(array $request_params)
    {
        $this->classExists();
        
        if (!array_key_exists('url', $request_params)) {

        }

        if (!array_key_exists('headers', $request_params)) {

        }

        extract($request_params);

        if (array_key_exists('body', $request_params)) {
            $request = \Httpful\Request::put($url)
                ->addHeaders($headers)
                ->body($body)
                ->send();
        } else {
            $request = \Httpful\Request::put($url)
                ->addHeaders($headers)
                ->send();
        }
    }

    public function deleteRequest(array $request_params)
    {
        $this->classExists();
        
        if (!array_key_exists('url', $request_params)) {

        }

        if (!array_key_exists('headers', $request_params)) {

        }

        extract($request_params);

        $request = \Httpful\Request::delete($url)
            ->addHeaders($headers)
            ->send();
    }

    /**
     * Format the request from the HTTP library into a consistent format
     * 
     * @return array A formatted request with the neccessary information to parse the result of the request
     */
    public function formatrequest($request)
    {

    }
}