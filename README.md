Installation
-------------

```shell
$    composer require hughes/spgateway-core
```

## ResponseVerifier

### 使用 ResponseVerifier 接收取號

```php
<?php

    use VeryBuy\Payment\Spgateway\Core\ResponseVerifier;

    $response = (new ResponseVerifier)->customer({response json string});

    $response->isSuccess();         // 回應是否成功
    $response->isCvs();             // 回應是否為超商代碼
    $response->getCvsCode();        // 取得超商代碼
    $response->getExpiredAt();      // 繳費到期時間
    $response->getAmount();         // 付款金額
    $response->getOrderNumber();    // 訂單編號
    $response->getId();             // 智付通自訂 id
```

### Response for spgateway 接收付款

```php
<?php

    use VeryBuy\Payment\Spgateway\Core\ResponseVerifier;

    $response = (new ResponseVerifier)->notify({response json string});

    $response->isSuccess();         // 回應是否成功
    $response->isCvs();             // 回應是否為超商代碼
    $response->getCvsCode();        // 取得超商代碼
    $response->getPaidAt();         // 繳費到期時間
    $response->getAmount();         // 付款金額
    $response->getOrderNumber();    // 訂單編號
    $response->getId();             // 智付通自訂 id
```