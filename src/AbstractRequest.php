<?php

namespace VeryBuy\Payment\Spgateway\Core;

use VeryBuy\Payment\Spgateway\Core\Support\RequestContract;

abstract class AbstractRequest implements RequestContract
{
    /**
     * @var array
     */
    protected $arguments = [];

    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @return array
     */
    protected function getArguments(): array
    {
        return $this->arguments;
    }

    abstract public function validate();
}