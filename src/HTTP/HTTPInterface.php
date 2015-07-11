<?php

namespace Caspio\HTTP;

interface HTTPInterface
{
    /**
     * Verify the existence of the HTTP Library class
     * 
     * Before you're able to use the HTTP class to make requests, verify that the needed class exists.
     * 
     * @return bool|Error If the class exists, return true. Otherwise, throw a Fatal error
     */
    public function classExists();

    /**
     * Make a HTTP GET request to the API endpoint
     * 
     * @param array Request parameters with a URL and the proper headers set
     * @return string The result of the HTTP request
     */
    public function getRequest(array $request_params);

    /**
     * Make a HTTP POST request to the API endpoint
     * 
     * @param array Request parameters with a URL and the proper headers set
     * @return string The result of the HTTP request
     */
    public function postRequest(array $request_params);

    /**
     * Make a HTTP PUT request to the API endpoint
     * 
     * @param array Request parameters with a URL and the proper headers set
     * @return string The result of the HTTP request
     */
    public function putRequest(array $request_params);

    /**
     * Make a HTTP DELETE request to the API endpoint
     * 
     * @param array Request parameters with a URL and the proper headers set
     * @return string The result of the HTTP request
     */
    public function deleteRequest(array $request_params);

    /**
     * Format the response from the HTTP library into a consistent format
     * 
     * @return array A formatted response with the neccessary information to parse the result of the request
     */
    public function formatResponse($response);
}