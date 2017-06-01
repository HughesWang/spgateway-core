<?php

namespace Tests\Payment\Spgateway\Core;

use VeryBuy\Payment\Spgateway\Core\ResponseVerifier;

class ResponseVerifierTest extends AbstractTestCase
{
	protected $customerStub = '{"Status":"SUCCESS","Message":"\u4ee3\u78bc\u53d6\u865f\u6210\\u529f","Result":"{\"MerchantID\":\"MS31685353\",\"Amt\":\"5000\",\"TradeNo\":\"17060112090104176\",\"MerchantOrderNo\":\"T1496290096\",\"CheckCode\":\"E90E29D5FEEDD6859C44BAEEF1834B92EF2D9B6DA89038AF6951FFD3C593266A\",\"PaymentType\":\"CVS\",\"ExpireDate\":\"2017-06-08\",\"ExpireTime\":\"23:59:59\",\"CodeNo\":\"TEST1234567890\"}"}';

    protected $notifyStub = '{"Status":"SUCCESS","Message":"\u6a21\u64ec\u4ed8\u6b3e\u6210\u529f","Result":"{\"MerchantID\":\"MS31685353\",\"Amt\":5000,\"TradeNo\":\"17060112090104176\",\"MerchantOrderNo\":\"T1496290096\",\"RespondType\":\"JSON\",\"Gateway\":\"MPG\",\"IP\":\"101.9.149.0\",\"EscrowBank\":\"KGI\",\"CheckCode\":\"E90E29D5FEEDD6859C44BAEEF1834B92EF2D9B6DA89038AF6951FFD3C593266A\",\"CodeNo\":\"TEST1234567890\",\"PaymentType\":\"CVS\",\"PayTime\":\"2017-06-01 12:10:04\"}"}';

    protected $failedStub = '{"Status":"MPG02002","Message":"\u6a21\u64ec\u4ed8\u6b3e\u6210\u529f","Result":"{\"MerchantID\":\"MS31685353\",\"Amt\":5000,\"TradeNo\":\"17060112090104176\",\"MerchantOrderNo\":\"T1496290096\",\"RespondType\":\"JSON\",\"Gateway\":\"MPG\",\"IP\":\"101.9.149.0\",\"EscrowBank\":\"KGI\",\"CheckCode\":\"E90E29D5FEEDD6859C44BAEEF1834B92EF2D9B6DA89038AF6951FFD3C593266A\",\"CodeNo\":\"TEST1234567890\",\"PaymentType\":\"CVS\",\"PayTime\":\"2017-06-01 12:10:04\"}"}';

	/**
	 * @test
	 */
    public function 測試智付通取得超商代碼回應格式正確()
    {
    	$response = (new ResponseVerifier)
    		->customer($this->customerStub);

        $this->assertEquals('2017-06-08 23:59:59', $response->getExpiredAt());
        $this->assertEquals('TEST1234567890', $response->getCvsCode());
        $this->assertTrue($response->isSuccess());
    }

    /**
     * @test
     */
    public function 測試智付通付款成功回應正確()
    {
        $response = (new ResponseVerifier)
            ->notify($this->notifyStub);

        $this->assertEquals('2017-06-01 12:10:04', $response->getPaidAt());
        $this->assertEquals('TEST1234567890', $response->getCvsCode());
        $this->assertTrue($response->isSuccess());
    }

    /**
     * @test
     */
    public function 測試智付通付款失敗回應正確()
    {
        $response = (new ResponseVerifier)
            ->notify($this->failedStub);

        $this->assertEquals('查無商店開啟任何金流服務', $response->getError());
    }
}
