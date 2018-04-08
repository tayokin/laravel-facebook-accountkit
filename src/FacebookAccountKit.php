<?php

declare(strict_types=1);

namespace Tayokin\FacebookAccountKit;

class FacebookAccountKit extends AccountKit
{
    /**
     * Get registered/loggedIn Account Data.
     *
     * @param string $code
     *
     * @return array
     *
     * @throws \RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccountData(string $code): array
    {
        /** @var mixed $data */
        $data = $this->getAccountDataByCode($code);

        return [
            'id'    => $data->id,
            'phone' => isset($data->phone) ? $data->phone->number : null,
            'email' => isset($data->email) ? $data->email->address : null,
        ];
    }
}
