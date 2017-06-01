<?php

namespace VeryBuy\Payment\Spgateway\Core\Responses;

use OutOfRangeException;

trait CanControlError
{
    /**
     * @var array
     */
    protected $errors = [
        'MPG01001' => '會員參數不可空白/設定錯誤(LoginType)',
        'MPG01002' => '時間戳記不可空白(TimeStamp)',
        'MPG01005' => 'TokenTerm不可空白/設定錯誤',
        'MPG01008' => '分期參數設定錯誤(InstFlag)',
        'MPG01009' => '商店代號不可空白(MerchantID)',
        'MPG01010' => '程式版本設定錯誤(Version)',
        'MPG01011' => '回傳規格設定錯誤(RespondType)',
        'MPG01012' => '商店訂單編號不可空白/設定錯誤(MerchantOrderNo：限英數字、
底線，長度 20 字)',
        'MPG01013' => '付款人電子信箱設定錯誤(Email)',
        'MPG01014' => '網址設定錯誤(ReturnURL,NotifyURL,CustomerURL,ClientBackURL)',
        'MPG01015' => '訂單金額不可空白/設定錯誤(Amt)',
        'MPG01016' => '檢查碼不可空白(CheckValue)',
        'MPG01017' => '商品資訊不可空白(ItemDesc)',
        'MPG01018' => '繳費有效期限設定錯誤(ExpireDate)',
        'MPG02001' => '檢查碼錯誤(CheckValue)',
        'MPG02002' => '查無商店開啟任何金流服務',
        'MPG02003' => '支付方式未啟用，請洽客服中心',
        'MPG02004' => '送出後檢查，超過交易限制秒數',
        'MPG02005' => '送出後檢查，驗證資料錯誤',
        'MPG02006' => '系統發生異常，請洽客服中心',
        'MPG03001' => 'FormPost加密失敗',
        'MPG03002' => '拒絕交易IP',
        'MPG03003' => 'IP交易次數限制',
        'MPG03004' => '商店狀態已被暫停或是關閉，無法進行交易',
        'MPG03007' => '查無此商店代號',
        'MPG03008' => '已存在相同的商店訂單編號',
        'MPG03009' => '交易失敗',
    ];

    /**
     * @return string
     */
    public function getError(): string
    {
        if (!array_key_exists($this->getStatus(), $this->errors)) {
            throw new OutOfRangeException('Undefined error: '. $this->getStatus());
        }

        return $this->errors[$this->getStatus()];
    }
}
