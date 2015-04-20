<?php

namespace Omnipay\Gate2shop;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setMerchantId('');
        $this->gateway->setMerchantSiteId('');
        $this->gateway->setSecretKey('');

        $this->options = [
            'currency'  => 'USD',
            'items'     => [
                ['name' => 'Item Name 1', 'quantity' => 1, 'price' => '5'],
                ['name' => 'Item Name 2', 'quantity' => 1, 'price' => '5']
            ],
            'customfields' => [
                ['name' => 'customField1', 'value' => 'customField1 value'],
                ['name' => 'customField2', 'value' => 'customField2 value']
            ]
        ];
    }

    public function testPurchase()
    {
        $response = $this->gateway->purchase($this->options)->send();

        $this->assertFalse($response->isSuccessful());
        $this->assertTrue($response->isRedirect());
        $this->assertNull($response->getTransactionReference());
        $this->assertContains('gate2shop.com/ppp/purchase.do', $response->getRedirectUrl());
    }

    public function testCompletePurchaseSuccess()
    {

    }
}
