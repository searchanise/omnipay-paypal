<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;

class SubscriptionsGetSubscriptionRequestTest extends TestCase
{
    protected $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new SubscriptionsGetSubscriptionRequest($client, $request);
    }

    public function testEndpoint()
    {
        $this->request->setTransactionReference('TEST123');
        $this->assertStringEndsWith('/billing/subscriptions/TEST123', $this->request->getEndpoint());
    }
}

