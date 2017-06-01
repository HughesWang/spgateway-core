<?php

namespace VeryBuy\Payment\Spgateway\Core\Support;

use Illuminate\Contracts\Support\Arrayable;

interface RequestContract extends Arrayable
{
	const VERSION = 1.2;
	const LANGUAGE_ZH_TW = 'zh-tw';
	const LANGUAGE_EN = 'en';
	const REQUEST_URI_TEST = 'https://ccore.spgateway.com/MPG/mpg_gateway';
	const REQUEST_URI = 'https://core.spgateway.com/MPG/mpg_gateway';
	const RESPONSE_TYPE_STRING = 'String';
	const RESPONSE_TYPE_JSON = 'JSON';
	const LOGIN_TYPE_NEED = 1;
	const LOGIN_TYPE_NO_NEED = 0;
	const EMAIL_CAN_MODIFY = 1;
	const EMAIL_CAN_NOT_MODIFY = 0;
	const CVS_ENABLE = 1;
}