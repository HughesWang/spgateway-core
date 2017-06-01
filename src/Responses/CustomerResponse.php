<?php

namespace VeryBuy\Payment\Spgateway\Core\Responses;

use Carbon\Carbon;
use VeryBuy\Payment\Spgateway\Core\Responses\ResponseContract;

class CustomerResponse extends ResponseContract
{
	public function getExpiredAt()
	{
		$dateTime = $this->getResult()->ExpireDate.$this->getResult()->ExpireTime;

		return Carbon::parse($dateTime)->format('Y-m-d H:i:s');
	}
}
