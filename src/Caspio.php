<?php

namespace Caspio;
use Caspio\Tokens\AccessToken as AccessToken;
use \Httpful\Request as Request;

class Caspio
{
    public $access_token;

    public function __construct($access_token)
    {   
        $this->setAccessToken($access_token);
    }

    public function setAccessToken($access_token)
    {
        if ($access_token instanceof AccessToken) {
            $this->access_token = $access_token->access_token;
        } else {
            $this->access_token = $access_token;
        }
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
            ->send();

        return $response;
    }
}