<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;
use Omnipay\PayPal\RestGateway;

class SubscriptionsCreatProductRequestTest extends TestCase
{
    /** @var \Omnipay\PayPal\Message\RestCreateSubscriptionRequest */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new SubscriptionsCreateProductRequest($client, $request);

        $this->request->initialize(array(
            'name'              => 'Test product',
            'description'       => 'Test product description',
            'type'              => 'SERVICE',
            'category'          => 'OTHER',
            'image_url'         => 'https://example.com/test.png',
            'home_url'          => 'https://example.com',
        ));
    }

    public function testGetData()
    {
        $data = $this->request->getData();
        $this->assertEquals('Test product', $data['name']);
        $this->assertEquals('Test product description', $data['description']);
        $this->assertEquals('SERVICE', $data['type']);
        $this->assertEquals('https://example.com', $data['home_url']);
    }
}

