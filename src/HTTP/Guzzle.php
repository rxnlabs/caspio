<?php

namespace Caspio\HTTP;
use \Caspio\Exception\AdapterErrorException as AdapterErrorException;
use \Caspio\Exception\MissingParamException as MissingParamException;

class Guzzle implements HTTPInterface
{   

    /**
     * Instance of the GuzzleHttp Client class
     */
    public $client;

    /**
     * Verify the GuzzleHttp Client library is loaded
     * 
     * @return void
     */
    public function __construct()
    {
        $exist = class_exists('\GuzzleHttp\Client');

        if ($exist === false) {
            throw new AdapterErrorException('Cannot find the class Client in the namespace GuzzleHttp. Please make sure this class is loaded before using this adapter.');
        }

        $this->client = new Guzzle\Client();
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
        $this->verifyRequestKeys($request_params);

        extract($request_params);

        $request = $this->client->get($url, ['headers'=>$headers]);

        return $this->formatResponse($request);
    }

    public function postRequest(array $request_params)
    {
        $this->verifyRequestKeys($request_params);

        extract($request_params);

        if (array_key_exists('body', $request_params)) {
            $request = $this->client->post($url, ['headers'=>$headers, 'body'=>$body]);
        } else {
            $request = $this->client->post($url, ['headers'=>$headers]);
        }

        return $this->formatResponse($request);
    }

    public function putRequest(array $request_params)
    {
        $this->verifyRequestKeys($request_params);

        extract($request_params);

        if (array_key_exists('body', $request_params)) {
            $request = $this->client->put($url, ['headers'=>$headers, 'body'=>$body]);
        } else {
            $request = $this->client->put($url, ['headers'=>$headers]);
        }

        return $this->formatResponse($request);
    }

    public function deleteRequest(array $request_params)
    {
        $this->verifyRequestKeys($request_params);

        extract($request_params);

        if (array_key_exists('body', $request_params)) {
            $request = $this->client->delete($url, ['headers'=>$headers, 'body'=>$body]);
        } else {
            $request = $this->client->delete($url, ['headers'=>$headers]);
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

        $response->status = $request->getStatusCode();
        $response->headers = $request->getHeaders();
        $response->adapter = $request;

        return $response;
    }
}