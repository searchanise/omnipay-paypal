<?php
/**
 * PayPal Subscriptions Search Transaction Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal Subscriptions Search Transaction Request
 *
 * Use this call to search for the transactions within a subscription.
 *
 * This should be used on a regular basis to determine the success / failure
 * state of transactions on active subscriptions.
 *
 * ### Example
 * TODO
 *
 * ### Request Sample
 * TODO
 *
 * ### Response Sample
 * TODO
 *
 * ### Known Issues
 * TODO
 *
 * @see SubscriptionsCreateSubscriptionRequest
 * @link https://developer.paypal.com/docs/api/subscriptions/v1/#subscriptions_transactions
 */
class SubscriptionsSearchTransactionRequest extends AbstractRestRequest
{
    /**
     * Get the subscription ID
     *
     * @return string
     */
    public function getSubscriptionId()
    {
        return $this->getParameter('subscriptionId');
    }

    /**
     * Set the subscription ID
     *
     * @param string $value
     * @return SubscriptionsSearchTransactionRequest provides a fluent interface.
     */
    public function setSubscriptionId($value)
    {
        return $this->setParameter('subscriptionId', $value);
    }

    /**
     * Get the request startTime
     *
     * @return string
     */
    public function getStartTime()
    {
        return $this->getParameter('startTime');
    }

    /**
     * Set the request startTime
     *
     * @param string|DateTime $value
     * @return SubscriptionsSearchTransactionRequest provides a fluent interface.
     */
    public function setStartTime($value)
    {
        return $this->setParameter('startTime', is_string($value) ? new \DateTime($value) : $value);
    }

    /**
     * Get the request endTime
     *
     * @return string
     */
    public function getEndTime()
    {
        return $this->getParameter('endTime');
    }

    /**
     * Set the request endTime
     *
     * @param string|DateTime $value
     * @return SubscriptionsSearchTransactionRequest provides a fluent interface.
     */
    public function setEndTime($value)
    {
        return $this->setParameter('endTime', is_string($value) ? new \DateTime($value) : $value);
    }

    public function getData()
    {
        $this->validate('subscriptionId', 'startTime', 'endTime');
        return [
            'start_time' => $this->getStartTime()->format('Y-m-d\TH:i:s\Z'),
            'end_time'   => $this->getEndTime()->format('Y-m-d\TH:i:s\Z'),
        ];
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for searchTransaction requests must be GET.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/billing/subscriptions/' .
            $this->getSubscriptionId() . '/transactions';
    }
}
