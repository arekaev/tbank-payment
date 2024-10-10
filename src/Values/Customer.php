<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class Customer extends Value
{
    /**
     * Идентификатор покупателя в системе продавца
     *
     * @var string
     */
    protected string $CustomerKey;

    /**
     * IP-адрес покупателя
     *
     * @var string|null
     */
    protected ?string $IP = null;

    public function __construct(string $CustomerKey)
    {
        $this->setCustomerKey($CustomerKey);
    }

    public static function make(string $CustomerKey): Customer
    {
        return new static($CustomerKey);
    }

    public function setCustomerKey(string $CustomerKey): Customer
    {
        $this->CustomerKey = $CustomerKey;
        return $this;
    }

    public function setIP(?string $IP): Customer
    {
        if ($IP !== null) {
            Validator::validateIp($IP);
        }

        $this->IP = $IP;
        return $this;
    }
}