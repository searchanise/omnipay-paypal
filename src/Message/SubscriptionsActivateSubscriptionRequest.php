<?php
/**
 * PayPal Subscriptions Activate Subscription Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal Subscriptions Activate Subscription Request
 *
 * Use this call to activate an subscriptions.
 *
 * ### Request Data
 *
 * TODO
 *
 * ### Example
 *
 * To create the agreement, see the code example in RestCreateSubscriptionRequest.
 *
 * TODO
 *
 * ### Request Sample
 *
 * TODO
 *
 * @link https://developer.paypal.com/docs/api/subscriptions/v1/#subscriptions_activate
 * @see Omnipay\PayPal\SubscriptionsGateway
 */
class SubscriptionsActivateSubscriptionRequest extends AbstractRestRequest
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
            $this->getTransactionReference() . '/activate';
    }
}

