<?php

namespace VeryBuy\Payment\Spgateway\Core\BuilderTrait\Request;

trait EncryptVerifyCodeTrait
{
    protected function encrypt(array $arguments): string
    {
    	$encrypt = http_build_query([
    		'HashKey' => $this->config['HashKey'],
    		'Amt' => $arguments['Amt'],
    		'MerchantID' => $arguments['MerchantID'],
    		'MerchantOrderNo' => $arguments['MerchantOrderNo'],
    		'TimeStamp' => $arguments['TimeStamp'],
    		'Version' => $arguments['Version'],
    		'HashIV' => $this->config['HashIV'],
		]);

    	return strtoupper(hash('sha256', $encrypt));
    }
}
