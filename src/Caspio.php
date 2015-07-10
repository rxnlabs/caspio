<?php

namespace Caspio;
use Caspio\Tokens\AccessToken as AccessToken;

class Caspio
{
    public $access_token;
    public $response_format_header = 'application/json';
    public $http_adapter;
    public $oauth_headers;

    public function __construct($access_token)
    {   
        $this->setAccessToken($access_token);
        $this->oauth_headers = array(
            'Authorization'=>'Bearer '.$this->access_token
            );
    }

    /**
     * Set the HTTP Adapter
     * 
     * Set the type of HTTP adapter we're using
     * 
     * @return void
     */
    public function setHTTPAdapter(HTTPInterface $adapter)
    {
        $this->http_adapter = $adapter;
    }

    /**
     * Get the HTTP Adapter
     * 
     * Get the type of HTTP Adaptor being used
     * 
     * @return HTTPInterface adapter
     */
    public function getHTTPAdapter()
    {
        return $this->http_adapter;
    }

    public function setAccessToken($access_token)
    {
        if ($access_token instanceof AccessToken) {
            $this->access_token = $access_token->access_token;
        } else {
            $this->access_token = $access_token;
        }

        $this->oauth_headers['Authorization'] = 'Bearer '.$this->access_token;
    }

    public function setReponseFormat($response_type)
    {
        $response_type = strtolower($response_type);
        switch ($response_type) {
            case 'xml': 
                $this->response_format_header = 'application/xml';
                break;
            case 'json':
                $this->response_format_header = 'application/json';
                break;
            default:
                $this->response_format_header = 'application/json';
                break;
        }

        $this->oauth_headers['Accept'] = $this->response_format_header;
    }

    public function testAPIAccessToken($access_token = '')
    {
        $this->access_token = $this->token_class->testAccessToken($access_token);
    }

    public function getRowByID($rest_url, $table, $id)
    {
        $url = sprintf($rest_url.$table.'/rows?q=%s', urlencode(json_encode(array('where'=>'PK_ID = '.$id))));
        $response = Request::get($url)
            ->addHeader('Authorization','Bearer '.$this->access_token)
            ->addHeader('Accept', $this->response_format_header)
            ->send();
        $request_params = array(
                'url'=>$url,
                'headers'=>$oauth_headers
            );
        $reponse = $this->getHTTPAdapter()->getRequest($request_params);

        return $response;
    }

    public function updateRowByID($rest_url, $table, $id, $fields)
    {
        $url = sprintf($rest_url.$table.'/rows?q=%s', urlencode(json_encode(array('where'=>'PK_ID = '.$id))));
        $response = Request::put($url)
            ->addHeader('Authorization','Bearer '.$this->access_token)
            ->addHeader('Accept', $this->response_format_header)
            ->body(json_encode($fields))
            ->send();

        return $response;
    }

    public function deleteRowByID($rest_url, $table, $id)
    {
        $url = sprintf($rest_url.$table.'/rows?q=%s', urlencode(json_encode(array('where'=>'PK_ID = '.$id))));
        $response = Request::delete($url)
            ->addHeader('Authorization','Bearer '.$this->access_token)
            ->addHeader('Accept', $this->response_format_header)
            ->send();

        return $response;
    }
}