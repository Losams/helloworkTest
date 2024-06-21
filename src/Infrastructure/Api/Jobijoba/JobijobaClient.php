<?php 

declare(strict_types=1);

namespace App\Infrastructure\Api\Jobijoba;

use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use App\Infrastructure\Api\Jobijoba\Request\JobijobaRequestInterface;

class JobijobaClient
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private string $jobijobaClientId,
        private string $jobijobaClientSecret,
    )
    {
    }

    public function get(JobijobaRequestInterface $request): ResponseInterface
    {
        $accessToken = $this->getAccessToken();

        $response = $this->httpClient->request(
            'GET',
            'https://api.jobijoba.com/v3/fr/ads/search?'.http_build_query($request->getParams()),
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$accessToken
                ]
            ]
        );

        return $response;
    }

    private function getAccessToken(): string
    {
        // TODO put that into correct httpclient interface

        //Récupération du token
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://api.jobijoba.com/v3/fr/login');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(['client_id' =>
            $this->jobijobaClientId, 'client_secret' => $this->jobijobaClientSecret]));
        $response = json_decode(curl_exec($curl));
        curl_close($curl);

        return  $response->token;
    }
}
