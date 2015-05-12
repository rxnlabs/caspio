<?php

namespace Caspio\Tokens;
use Caspio\Errors\Error as Error;
use \Httpful\Request as Request;

class AccessToken
{
    public $client_id;
    public $client_secret;
    public $oauth_path;
    public $caspio_tables_url;
    public $access_token;
    public $refresh_token;

    public function __construct($oauth_path = '', $client_id = '' , $client_secret = '')
    {
        if (!empty($oauth_path) || !empty($client_id) || !empty($client_secret)) {
            $this->client_id = $client_id;
            $this->client_secret = $client_secret;
            $this->oauth_path = $oauth_path;
        }
    }

    public function createAccessToken($oauth_path = '', $client_id = '', $client_secret = '')
    {   
        if (empty($client_id) || empty($client_secret) || empty($oauth_path)) {
            $client_id = $this->client_id;
            $client_secret = $this->client_secret;
            $oauth_path = $this->oauth_path;
        }

        if (empty($client_id) || empty($client_secret) || empty($oauth_path)) {
            $error = new Error(404, 'Missing arguments $client_id, $client_secret, $oauth_path');
            return $error->get_error_code();
        }

        $body = array('grant_type'=>'client_credentials');
        $encode_creds = base64_encode(sprintf('%1$s:%2$s', $client_id, $client_secret));
        $response = Request::post($oauth_path)
            ->addHeader('Content-Type','application/x-www-form-urlencoded')
            ->addHeader('Authorization','Basic '.$encode_creds)
            ->body(http_build_query($body))
            ->send();
        if ($response->code == 200) {
            $this->access_token = $response->body->access_token;
            $this->refresh_token = $response->body->refresh_token;
            return $response->body;
        } else {
            $error = new Error(404, 'Missing arguments $client_id, $client_secret, $oauth_path');
            return $error->get_error_code();
        }
    }

    public function renewAccessToken($refresh_url = '', $client_id = '', $client_secret = '', $refresh_token = '')
    {
        if (empty($refresh_url)) {
            $refresh_url = $this->$oauth_path;
        }

        if (empty($refresh_token)) {
            $refresh_token = $this->refresh_token;
        }

        if (empty($client_id)) {
            $client_id = $this->client_id;
        }

        if (empty($client_secret)) {
            $client_secret = $this->client_secret;
        }

        if (empty($refresh_token) || empty($refresh_url) || empty($client_id) || empty($client_secret)) {
            $error = new Error(404, 'Missing arguments $refresh_url, $client_id, $client_secret or $refresh_token');
            return $error->get_error_code();
        }

        $body = array('grant_type'=>'refresh_token','refresh_token'=>$refresh_token);
        $encode_creds = base64_encode(sprintf('%1$s:%2$s', $client_id, $client_secret));
        $response = Request::post($refresh_url)
            ->addHeader('Content-Type','application/x-www-form-urlencoded')
            ->addHeader('Authorization','Basic '.$encode_creds)
            ->body(http_build_query($body))
            ->send();

        if ($response->code == 200) {
            $this->access_token = $response->body->access_token;
            $this->refresh_token = $response->body->refresh_token;
            return $response->body;
        } else {
            return false;
        }
    }

    public function isAccessTokenValid($tables_url, $access_token = '')
    {
        if (empty($access_token)) {
            $access_token = $this->access_token;
        }

        if (empty($access_token) || empty($tables_url)) {
            $error = new Error(404, 'Missing arguments $access_token and $tables_url');
            return $error->get_error_code();
        }

        $response = Request::get($tables_url)
            ->addHeader('Authorization','Bearer '.$access_token)
            ->send();

        if ($response->code == 200) {
            return true;
        } else {
            return false;
        }
    }
}