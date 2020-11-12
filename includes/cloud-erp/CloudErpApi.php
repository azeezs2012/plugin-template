<?php

defined( 'ABSPATH' ) or die();

class CloudErpApi
{
    public $apiUrl = 'http://localhost:8000/api';

    public $apiKey = null;

    public function __construct($key, $api_url) {
        $this->apiKey = $key;
        $this->apiUrl = $api_url;
    }

    function get( $endpoint, $data = [] ) {

        $url = $this->apiUrl . '/' . $endpoint . '?' . http_build_query( $data );

        $data['wp_token'] = $this->apiKey;

        $response = wp_remote_get( $url, [
            'timeout' => 40,
            'body'    => $data
        ] );

        return $response;
    }

    function post( $endpoint, $data = [] ) {

        $url = self::$apiUrl . '/' . $endpoint;

        $data['wp_token'] = $this->apiKey;

        $response = wp_remote_post( $url, [
            'timeout' => 40,
            'body'    => $data
        ] );

        return $response;
    }
}