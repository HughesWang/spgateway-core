<?php

namespace VeryBuy\Payment\Spgateway\Core\Responses;

use VeryBuy\Payment\Spgateway\Core\Responses\InterfaceResponse;

trait CanUseCvs
{
    /**
     * @return boolean
     */
    public function isCvs(): bool
    {
        return ($this->getPayType() === InterfaceResponse::PAYMENT_TYPE_CVS);
    }

    /**
     * @return string
     */
    public function getCvsCode(): string
    {
        return $this->getResult()->CodeNo;
    }
}
