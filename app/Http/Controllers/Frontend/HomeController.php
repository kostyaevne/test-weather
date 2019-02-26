<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Data;
use App\Http\Requests\DataRequest;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if(request()->getMethod() == "POST")
        {
            return $this->postIndex();
        }

        return $this->getIndex();
    }

    public function getIndex()
    {
        return view('welcome');
    }

    public function postIndex()
    {
        request()->validate((new DataRequest())->rules());

        $ipApi = new \App\Helpers\IpApiHelper;
        $location = $ipApi->getLocation($_SERVER['REMOTE_ADDR']);
        $weatherApi = new \App\Helpers\WeatherApiHelper;
        $weather = $weatherApi->getWeatherByIP($location->query);
        foreach(request()->input('clients') as $client) {
            $tmp_weather = "{$weather->current->temp_c} &deg;\nHumidity:{$weather->current->humidity}%\nWind:{$weather->current->wind_kph}km/h";
            Data::create(array_merge($client, ['country' => $location->country, 'weather' => $tmp_weather]));
        }

        return redirect()->back()->with(['success' => true]);
    }
}
