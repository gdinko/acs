<?php

namespace Gdinko\Acs;

use Gdinko\Acs\Exceptions\AcsException;
use Illuminate\Support\Facades\Http;

trait MakesHttpRequests
{
    public function get($uri)
    {
        return $this->request('get', $uri);
    }

    public function post($uri, array $data = [])
    {
        return $this->request('post', $uri, $data);
    }

    public function put($uri, array $data = [])
    {
        return $this->request('put', $uri, $data);
    }

    public function request($verb, $uri, $data = [])
    {
        $response = Http::withHeaders([
            'AcsApiKey' => $this->getApiKey()
        ])
            ->timeout($this->timeout)
            ->baseUrl($this->baseUrl)
            ->{$verb}($uri, $data)
            ->throw(function ($response, $e) {
                throw new AcsException(
                    $e->getMessage(),
                    $e->getCode(),
                    $response->json()
                );
            });

        return $response->json();
    }
}
