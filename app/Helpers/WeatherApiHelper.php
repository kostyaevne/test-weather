<?php

namespace App\Helpers;


class WeatherApiHelper
{
    private $api_url = "http://api.apixu.com/v1/current.json";
    private $api_key = "7999af077e4a4280a3b84635192502";

    function getWeatherByIP($ip = '188.190.83.138')
    {
        $curl = curl_init();
        $options = [
            CURLOPT_URL => "{$this->api_url}?key={$this->api_key}&q={$ip}",
            CURLOPT_RETURNTRANSFER => true
        ];

        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);

        return json_decode($result);
    }
}