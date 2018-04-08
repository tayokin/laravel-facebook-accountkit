<?php

declare(strict_types=1);

namespace Tayokin\FacebookAccountKit;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class AccountKit
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $baseUri = 'https://graph.accountkit.com/v1.3';

    /**
     * @var string
     */
    private $accessTokenParam = 'access_token';

    /**
     * @var string
     */
    private $meParam = 'me';

    /**
     * AccountKit constructor.
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Get Returned Data.
     *
     * @param string $code
     *
     * @return mixed
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccountDataByCode(string $code)
    {
        return $this->getContentBody($this->getMeEndpointUrl($this->getAccessTokenByCode($code)));
    }

    /**
     * Get Access token by Code.
     *
     * @param string $code
     *
     * @return string
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getAccessTokenByCode(string $code): string
    {
        $accessTokenUrl = $this->getAccessTokenUrl($code, $this->getFacebookAppID(), $this->getFacebookAppSecret());

        return $this->getContentBody($accessTokenUrl)->access_token;
    }

    /**
     * Make Request To AccountKit and returns Body.
     *
     * @param string $url
     *
     * @return mixed
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function getContentBody(string $url)
    {
        $data = $this->client->request('GET', $url);

        return json_decode($data->getBody());
    }

    /**
     * Get Token Url.
     *
     * @param string $code
     * @param string $appId
     * @param string $appSecret
     *
     * @return string
     */
    private function getAccessTokenUrl(string $code, string $appId, string $appSecret): string
    {
        return $this->baseUri.'/'.$this->accessTokenParam.'/'.
            '?grant_type=authorization_code'.
            '&code='.$code.
            '&access_token=AA|'.$appId.'|'.$appSecret;
    }

    /**
     * Get Me Endpoint Url.
     *
     * @param string $accessToken
     *
     * @return string
     */
    private function getMeEndpointUrl(string $accessToken): string
    {
        return $this->baseUri.'/'.$this->meParam.'/'.
            '?access_token='.$accessToken.
            '&appsecret_proof='.hash_hmac('sha256', $accessToken, config('accountKit.accountKitAppSecret'));
    }

    /**
     * Get Facebook App Id.
     *
     * @return string
     */
    private function getFacebookAppID(): string
    {
        return Config::get('accountKit.accountKitAppId');
    }

    /**
     * Get Facebook App Secret.
     *
     * @return string
     */
    private function getFacebookAppSecret(): string
    {
        return Config::get('accountKit.accountKitAppSecret');
    }
}
