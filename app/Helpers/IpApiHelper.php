<?php

namespace App\Helpers;

class IpApiHelper
{
    private $api_url = "http://ip-api.com/json/";

    function getLocation(string $ip) {
        $curl = curl_init();

        $options = [
            CURLOPT_URL => $this->api_url . $ip,
            CURLOPT_RETURNTRANSFER => true
        ];

        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);

        return json_decode($result);
    }
}