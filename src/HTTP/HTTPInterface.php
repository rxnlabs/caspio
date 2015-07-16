<?php

namespace Caspio\HTTP;

interface HTTPInterface
{

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