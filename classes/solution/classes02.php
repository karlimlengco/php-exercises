<?php

/**
 * Copyright 2017 REVLV Solutions Inc
 * Licensed under the GNU GPLv3
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 */
require_once('../../utils/index.php');

/**
 * Configure the API KEY
 */
define('OPEN_WEATHER_MAP_API_KEY', '4089827dcc509de782c520a56d410416');
define('APIXU_API_KEY', 'fe2e523a3bab437f89191431172505');

interface ForecasterInterface {
    public function getForecast($city);
}

class WeatherResponse
{
    public $city;
    public $humidity;
    public $pressure;
    public $temperature;

    public function __construct($city, $humidity, $pressure, $temperature)
    {
        $this->city = $city;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->temperature = $temperature;
    }
}

class Apixu implements ForecasterInterface
{
    protected $baseUrl = 'https://api.apixu.com/v1/current.json';
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getForecast($city)
    {
        $response = file_get_contents(
            sprintf('%s?q=%s&key=%s', $this->baseUrl, $city, $this->apiKey)
        );

        $e = json_decode($response);

        return new WeatherResponse(
            $e->location->name,
            $e->current->pressure_mb,
            $e->current->humidity,
            $e->current->temp_c
        );
    }
}

class OpenWeatherMap implements ForecasterInterface
{
    protected $baseUrl = 'http://api.openweathermap.org/data/2.5';
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function getForecast($city)
    {
        $response = file_get_contents(
            sprintf('%s/weather?q=%s&APPID=%s', $this->baseUrl, $city, $this->apiKey)
        );

        $e = json_decode($response);

        return new WeatherResponse(
            $e->name,
            $e->main->pressure,
            $e->main->humidity,
            $e->main->temp
        );
    }
}

/**
 * Who needs reporters if we can get the data through the internet right?
 * You have given task to gather data from the interwebs.
 *
 * Your boss needs the following data:
 *     City
 *     Humidity
 *     Pressure
 *     Temperature both in Celcius
 *
 *  Open weather map API format:
 *  http://api.openweathermap.org/data/2.5/weather?q=CITY&APPID=API_KEY
 *
 *  APIXU API format:
 *  https://api.apixu.com/v1/current.json?key=API_KEY&q=CITY
 *
 *  Your boss demands that you write both of these services immediately, so when
 *  the other ones are down, we can get easily swap-out implementation without
 *  having issue.
 */
class Forecast
{
    protected $forecaster;

    public function __construct(ForecasterInterface $forecaster)
    {
        $this->forecaster = $forecaster;
    }

    /**
     * Get the forecast for the specific city
     * @param  string $city
     * @return
     */
    public function getForecast($city)
    {
        return $this->forecaster->getForecast($city);
    }
}

$forecast = new Forecast(
    new OpenWeatherMap(OPEN_WEATHER_MAP_API_KEY)
);

a($forecast->getForecast('Manila') instanceof WeatherResponse, true);
a($forecast->getForecast('Manila')->city, 'Manila');

$forecast = new Forecast(
    new Apixu(APIXU_API_KEY)
);

a($forecast->getForecast('Manila') instanceof WeatherResponse, true);
a($forecast->getForecast('Manila')->city, 'Manila');
