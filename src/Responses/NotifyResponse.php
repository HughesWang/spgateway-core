<?php

namespace VeryBuy\Payment\Spgateway\Core\Responses;

use Carbon\Carbon;
use VeryBuy\Payment\Spgateway\Core\Responses\ResponseContract;

class NotifyResponse extends ResponseContract
{
    /**
     * @return string
     */
    public function getPaidAt(): string
    {
        return Carbon::parse($this->getResult()->PayTime)->format('Y-m-d H:i:s');
    }
}
