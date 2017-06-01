<?php

namespace VeryBuy\Payment\Spgateway\Core\Responses;

interface InterfaceResponse
{
	const RESPONSE_SUCCESS = 'SUCCESS';
	const PAYMENT_TYPE_CVS = 'CVS';

    /**
     * @return boolean
     */
    public function isSuccess(): bool;

    /**
     * @return string
     */
    public function getCode(): string;
}
