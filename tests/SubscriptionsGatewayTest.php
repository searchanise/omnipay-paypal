<?php

namespace Omnipay\PayPal;

use Omnipay\Tests\GatewayTestCase;

class SubscriptionsGatewayTest extends GatewayTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->gateway = new SubscriptionsGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setToken('TEST-TOKEN-123');
        $this->gateway->setTokenExpires(time() + 600);
    }

    public function testCreateProduct()
    {
        $this->setMockHttpResponse('SubscriptionsCreateProductSuccess.txt');

        $data = [
            'name' => 'Test product 123',
            'description' => 'Test product description 123',
            'type' => 'SERVICE',
            'category' => 'AC_REFRIGERATION_REPAIR',
            'image_url' => 'https://example.com/image.png',
            'home_url' => 'https://example.com',
        ];

        $response = $this->gateway->createProduct($data)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertNull($response->getMessage());

        $this->assertEquals('PROD-16025810AX838144E', $response->getTransactionReference());
    }

    public function testCreatePlan()
    {
        $this->setMockHttpResponse('SubscriptionsCreatePlanSuccess.txt');

        $data = [
            'name' => 'Test plan 123',
            'period' => 'MONTH',
            'cost' => '10.00'
        ];

        $response = $this->gateway->createPlan($data)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertNull($response->getMessage());

        $this->assertEquals('P-64D673538H963814RMLKDKZI', $response->getTransactionReference());
    }

    public function testCreateSubscription()
    {
        $this->setMockHttpResponse('SubscriptionsCreateSubscriptionSuccess.txt');

        $data = [
            'plan_id' => 'P-64D673538H963814RMLKDKZI',
            'email' => 'test@example.com',
            'brand_name' => 'Searchanise',
            'return_url' => 'https://example.com/return',
            'cancel_url' => 'https://example.com/cancel',
        ];

        $response = $this->gateway->createSubscription($data)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertNull($response->getMessage());

        $this->assertEquals('I-H3HY7MXYJMEV', $response->getTransactionReference());

        $this->assertEquals('APPROVAL_PENDING', $response->getData()['status']);
    }

    public function testGetSubscription()
    {
        $this->setMockHttpResponse('SubscriptionsGetSubscriptionSuccess.txt');

        $data = [
            'subscription_id' => 'I-H3HY7MXYJMEV'
        ];

        $response = $this->gateway->getSubscription($data)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertNull($response->getMessage());

        $this->assertEquals('I-H3HY7MXYJMEV', $response->getTransactionReference());

        $this->assertEquals('ACTIVE', $response->getData()['status']);
    }
}
