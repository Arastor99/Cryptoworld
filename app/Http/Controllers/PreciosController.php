<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;


class PreciosController extends Controller
{

    protected $api_url;   // url base de la api

    public function __construct($api_url = null)
    {
        $this->api_url = (!empty($api_url)) ? $api_url : config('binance-api.urls.api');

    }

    private function sendApiRequest($url, $method)
    {
        try {
            if ($method == 'POST') {
                $response = Http::withHeaders([])->post($url);
            }
            if ($method == 'GET') {
                $response = Http::withHeaders([])->get($url);
            }
        } catch (ConnectionException $e) {
            return $error = [
                'code'    => $e->getCode(),
                'error'   => 'Host no encontrado',
                'message' => 'No se puede encontrar el host: '.$this->api_url,
            ];
        } catch (Exception $e) {
            return $error = [
                'code'    => $e->getCode(),
                'error'   => 'cUrl Error',
                'message' => $e->getMessage(),
            ];
        }

        // Si la respuesta es valida devuelve la coleccion
        if ($response->ok()) {
            return $response->collect();
        } else {
            return $this->handleError($response);
        }
    }
    private function publicRequest($url, $params = [], $method = 'GET')
    {
        $url = $this->api_url.$url;

        $url = $url.'?'.http_build_query($params);

        return $this->sendApiRequest($url, $method);
    }

    public function precio(string $symbol)
    {
        $datos = [
            'symbol' => $symbol ? strtoupper($symbol) : null,
        ];
        return $this->publicRequest("v3/ticker/price", $datos);
    }
}
