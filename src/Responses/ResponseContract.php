<?php

namespace VeryBuy\Payment\Spgateway\Core\Responses;

use Illuminate\Contracts\Support\Arrayable;
use VeryBuy\Payment\Spgateway\Core\Responses\CanControlError;
use VeryBuy\Payment\Spgateway\Core\Responses\CanUseCvs;
use VeryBuy\Payment\Spgateway\Core\Responses\CommonUsable;
use VeryBuy\Payment\Spgateway\Core\Responses\InterfaceResponse;
use stdClass;

abstract class ResponseContract implements InterfaceResponse, Arrayable
{
    use CommonUsable, CanUseCvs, CanControlError;

    /**
     * @var string
     */
    protected $raw;

    /**
     * @var object
     */
    protected $parsed;

    /**
     * @param string $json
     */
    public function __construct(string $json)
    {
        $this->raw = $json;

        $this->parsed = $this->parseResponseToObject($json);
    }

    /**
     * @param  string $json
     * @return stdClass
     */
    protected function parseResponseToObject(string $json): stdClass
    {
        $response = json_decode($json);
        $response->Result = json_decode($response->Result);

        return $response;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->parsed->Status;
    }

    /**
     * @return boolean
     */
    public function isSuccess(): bool
    {
        return ($this->getStatus() === InterfaceResponse::RESPONSE_SUCCESS);
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->parsed->Message;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return json_decode(json_encode($this->parsed), JSON_OBJECT_AS_ARRAY);
    }
}
