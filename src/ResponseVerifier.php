<?php

namespace VeryBuy\Payment\Spgateway\Core;

use VeryBuy\Payment\Spgateway\Core\Responses\CustomerResponse;
use VeryBuy\Payment\Spgateway\Core\Responses\NotifyResponse;
use VeryBuy\Payment\Spgateway\Core\Responses\ResponseContract;

class ResponseVerifier
{
    public function customer(string $json)
    {
        return new CustomerResponse($json);
    }

    public function notify(string $json)
    {
        return new NotifyResponse($json);
    }
}