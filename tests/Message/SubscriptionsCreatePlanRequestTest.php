<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;
use Omnipay\PayPal\RestGateway;

class SubscriptionsCreatePlanRequestTest extends TestCase
{
    /** @var \Omnipay\PayPal\Message\RestCreateSubscriptionRequest */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new SubscriptionsCreatePlanRequest($client, $request);

        $this->request->initialize([
            'product_id' => 'TEST123',
            'name'       => 'Test plan name',
            'period' => 'MONTH',
            'cost' => '10.00',
            'payment_preferences' => [
                'auto_bill_outstanding' => true,
                'payment_failure_threshold' => 3
            ],
            'taxes' => [
                'percentage' => '0',
                'inclusive' => true
            ],
            'quantity_supported' => false,
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals('Test plan name', $data['name']);
        $this->assertEquals('TEST123', $data['product_id']);
        $this->assertEquals('MONTH', $data['billing_cycles'][0]['frequency']['interval_unit']);
        $this->assertEquals('MONTH', $this->request->getPeriod());
        $this->assertEquals('3', $data['payment_preferences']['payment_failure_threshold']);
        $this->assertEquals('3', $this->request->getPaymentPreferences()['payment_failure_threshold']);
    }
}


