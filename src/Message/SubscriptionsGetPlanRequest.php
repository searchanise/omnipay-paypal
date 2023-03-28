<?php
/**
 * PayPal Subscriptions Get Plan Request
 */

namespace Omnipay\PayPal\Message;

use Omnipay\Common\Exception\RuntimeException;

/**
 * PayPal Subscriptions Create Plan Request
 *
 *
 * ### Request Data
 *
 *
 * ### Example
 *
 *
 * ### Request Sample
 *
 * ### Response Sample
 *
 *
 * @link https://developer.paypal.com/docs/api/subscriptions/v1/#plans_get
 * @see Omnipay\PayPal\RestGateway
 */
class SubscriptionsGetPlanRequest extends AbstractRestRequest
{
    protected $planId;

    public function getData()
    {
        return [];
    }

    public function initialize(array $parameters = [])
    {
        if (!empty($parameters['plan_id'])) {
            $this->planId = $parameters['plan_id'];
        }

        return parent::initialize($parameters);
    }

    /**
     * Get transaction endpoint.
     *
     * Billing plans are created using the /billing/plans resource.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return parent::getEndpoint() . '/billing/plans/' . $this->planId; 
    }

    protected function getHttpMethod()
    {
        return 'GET';
    }
}

