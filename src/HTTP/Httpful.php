<?php

namespace Caspio\HTTP;
use \Caspio\Exception\AdapterErrorException as AdapterErrorException;
use \Caspio\Exception\MissingParamException as MissingParamException;

class Httpful implements HTTPInterface
{   
    /**
     * Verify the Httpful library is loaded
     * 
     * @return void
     */
    public function classExists()
    {
        $exist = class_exists('\Httpful\Httpful');

        if ($exist === false) {
            throw new AdapterErrorException('Cannot find the class Httpful in the namespace Httpful. Please make sure this class is loaded before using this adapter.');
        }

        return true;
    }

    /**
     * Verify the array keys are included when making a request.
     * 
     * Array keys need to be passed before we're able to make a request to the API.
     * 
     * @return void
     */
    public function verifyRequestKeys(array $request_params)
    {
        if (!array_key_exists('url', $request_params) || empty($request_params['url'])) {
            throw new MissingParamException('Missing array key "url" in the parameter $request_params');
        }

        if (!array_key_exists('header', $request_params) || empty($request_params['header'])) {
            throw new MissingParamException('Missing array key "header" in the parameter $request_params');
        }
    }

    public function getRequest(array $request_params)
    {
        $this->classExists();
        $this->verifyRequestKeys($request_params);

        extract($request_params);

        $request = \Httpful\Request::get($url)
            ->addHeaders($header)
            ->send();

        return $this->formatResponse($request);
    }

    public function postRequest(array $request_params)
    {
        $this->classExists();
        $this->verifyRequestKeys($request_params);

        extract($request_params);

        if (array_key_exists('body', $request_params)) {
            $request = \Httpful\Request::post($url)
                ->addHeaders($header)
                ->body($body)
                ->send();
        } else {
            $request = \Httpful\Request::post($url)
                ->addHeaders($header)
                ->send();
        }

        return $this->formatResponse($request);
    }

    public function putRequest(array $request_params)
    {
        $this->classExists();
        $this->verifyRequestKeys($request_params);

        extract($request_params);

        if (array_key_exists('body', $request_params)) {
            $request = \Httpful\Request::put($url)
                ->addHeaders($header)
                ->body($body)
                ->send();
        } else {
            $request = \Httpful\Request::put($url)
                ->addHeaders($header)
                ->send();
        }

        return $this->formatResponse($request);
    }

    public function deleteRequest(array $request_params)
    {
        $this->classExists();
        $this->verifyRequestKeys($request_params);

        extract($request_params);

        if (array_key_exists('body', $request_params)) {
            $request = \Httpful\Request::delete($url)
                ->addHeaders($header)
                ->body($body)
                ->send();
        } else {
            $request = \Httpful\Request::delete($url)
                ->addHeaders($header)
                ->send();
        }

        return $this->formatResponse($request);
    }

    /**
     * Format the request from the HTTP library into a consistent format
     * 
     * Each HTTP Adapter response should return the body, headers, HTTP status code, and the actual response object from the HTTP library in case the client wants to use the response directly in their implementation.
     * 
     * @return array A formatted request with the neccessary information to parse the result of the request
     */
    public function formatResponse($request)
    {
        $response = new \stdClass();

        if ($request->hasBody()) {
            $response->body = $request->body;
        }

        if ($request->hasErrors()) {
            $response->error = true;
        }

        $response->status = $request->code;
        $response->headers = $request->headers;
        $response->adapter = $request;

        return $response;
    }
}