<?php

namespace VeryBuy\Payment\Spgateway\Core;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use VeryBuy\Payment\Spgateway\Core\BuilderTrait\Request\EncryptVerifyCodeTrait as EncryptVerifyCode;
use VeryBuy\Payment\Spgateway\Core\BuilderTrait\Request\HttpClientTrait as HttpClient;
use VeryBuy\Payment\Spgateway\Core\Support\RequestContract;
use InvalidArgumentException;

class RequestBuilder
{
	use EncryptVerifyCode, HttpClient;

	/**
	 * @var string
	 */
	protected $uri;

	/**
	 * @var array
	 */
	protected $config = [];

	public function __construct(array $config, string $uri)
	{
		$this->config = $config;

		$this->uri = $uri;
	}

	/**
	 * @return string
	 */
	protected function getUri(): string
	{
		return $this->uri;
	}

	/**
	 * @param  RequestContract $request
	 * @return array
	 */
    protected function getRequestArguments(RequestContract $request): array
    {
        $arguments = array_merge([
        	'MerchantID' => $this->config['MerchantID'],
        	'RespondType' => RequestContract::RESPONSE_TYPE_JSON,
        	'CheckValue' => null,
        	'TimeStamp' => time(),
        	'Version' => RequestContract::VERSION,
        	'LoginType' => RequestContract::LOGIN_TYPE_NO_NEED,
    	], $request->toArray());

        return array_merge($arguments, [
        	'CheckValue' => $this->encrypt($arguments)
    	]);
    }

    /**
     * @param  array  $arguments
     * @return string
     */
    protected function makeRequestForm(array $arguments): string
    {
    	$script = '<script>document.forms[name="spgateway"].submit();</script>';
    	$inputs = [];

    	foreach($arguments as $name => $value){
    		$inputs[] = strtr('<input type="text" name="{name}" value="{value}"/>', [
    			'{name}' => $name,
    			'{value}' => $value,
			]);
    	}

    	$inputs[] = '<button type="submit"></botton>';

    	return strtr('<form name="spgateway" method="POST" action="{uri}">{inputs}</form>{script}', [
    		'{uri}' => $this->getUri(),
    		'{inputs}' => implode('', $inputs),
    		'{script}' => $script
		]);
    }

    /**
     * @param  RequestContract $request
     * @return string
     */
	public function make(RequestContract $request): string
	{
       $request->validate();

		return $this->makeRequestForm(
			$this->getRequestArguments($request)
		);
	}
}