<?php

namespace VeryBuy\Payment\Spgateway\Core\Responses;

use stdClass;

trait CommonUsable
{
	/**
     * @return stdClass
     */
    protected function getResult(): stdClass
    {
        return $this->parsed->Result;
    }

	/**
	 * @return int
	 */
	public function getAmount(): int
	{
		return (int) $this->getResult()->Amt;
	}

	/**
	 * @return string
	 */
	public function getCompanyId(): string
	{
		return $this->getResult()->MerchantID;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->getResult()->TradeNo;
	}

	/**
	 * @return string
	 */
	public function getOrderNumber(): string
	{
		return $this->getResult()->MerchantOrderNo;
	}

    /**
     * @return string
     */
    protected function getPayType(): string
    {
        return $this->getResult()->PaymentType;
    }

    /**
     * @return string
     */
    protected function getVerifyCode(): string
    {
        return $this->getResult()->CheckCode;
    }
}
