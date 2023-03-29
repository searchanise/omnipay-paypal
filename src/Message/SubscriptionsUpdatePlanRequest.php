<?php
/**
 * PayPal Subscriptions Update Plan Request
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal Subscriptions Update Plan Request
 *
 *
 * @link https://developer.paypal.com/docs/api/subscriptions/v1/#plans_patch
 * @see Omnipay\PayPal\SubscriptionsGateway
 */
class SubscriptionsUpdatePlanRequest extends AbstractRestRequest
{
    public function getPath()
    {
        return $this->getParameter('path');
    }

    public function setPath($value)
    {
        return $this->setParameter('path', $value);
    }

    public function getValue()
    {
        return $this->getParameter('value');
    }

    public function setValue($value)
    {
        return $this->setParameter('value', $value);
    }

    public function getData()
    {
        $this->validate('transactionReference', 'path', 'value');
        $data = array(array(
            'path'      => $this->getPath(),
            'value'     => $this->getValue(),
            'op'        => 'replace'
        ));

        return $data;
    }

    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/billing/plans/' . $this->getTransactionReference();
    }

    protected function getHttpMethod()
    {
        return 'PATCH';
    }
}
