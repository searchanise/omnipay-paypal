<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;
use Omnipay\PayPal\RestGateway;

class SubscriptionsCreateSubscriptionRequestTest extends TestCase
{
    private $request;
    private $startDate;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new SubscriptionsCreateSubscriptionRequest($client, $request);

        $this->startDate = new \DateTime('tomorrow');

        $this->request->initialize([
            'plan_id' => 'TEST123',
            'email' => 'email@example.com',
            'brand_name' => 'Test brand',
            'start_time' => $this->startDate,
            'return_url' => 'https://example.com/return',
            'cancel_url' => 'https://example.com/cancel',
        ]);
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals('TEST123', $data['plan_id']);
        $this->assertEquals('email@example.com', $data['subscriber']['email_address']);
        $this->assertEquals($this->startDate, new \DateTime($data['start_time']));
        $this->assertEquals('Test brand', $data['application_context']['brand_name']);
        $this->assertEquals('https://example.com/return', $data['application_context']['return_url']);
    }
}
