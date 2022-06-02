<?php
/**
 * PayPal Subscriptions Suspend Subscription Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal Subscriptions Suspend Subscription Request
 *
 * ### Request Data
 *
 * ### Example
 *
 * ### Request Sample
 *
 * This is from the PayPal web site:
 *
 * @link https://developer.paypal.com/docs/api/subscriptions/v1/#subscriptions_suspend
 * @see SubscriptionsCreateSubscriptionRequest
 * @see Omnipay\PayPal\SubscriptionsGateway
 */
class SubscriptionsSuspendSubscriptionRequest extends AbstractRestRequest
{
    public function getData()
    {
        $this->validate('transactionReference', 'description');
        $data = array(
            'reason'  => $this->getDescription(),
        );

        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Subscriptions are executed using the /billing-agreements resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/billing/subscriptions/' .
            $this->getTransactionReference() . '/suspend';
    }
}


