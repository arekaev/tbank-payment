<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class AddCustomer extends Value
{
    /**
     * Идентификатор покупателя в системе продавца
     *
     * @var string
     */
    protected string $CustomerKey;

    /**
     * Электронная почта покупателя
     *
     * @var string|null
     */
    protected ?string $Email = null;

    /**
     * Телефон покупателя В формате +71234567890
     *
     * @var string|null
     */
    protected ?string $Phone = null;

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

    public static function make(string $CustomerKey): AddCustomer
    {
        return new static($CustomerKey);
    }

    public function setCustomerKey(string $CustomerKey): AddCustomer
    {
        $this->CustomerKey = $CustomerKey;
        return $this;
    }

    public function setEmail(?string $Email): AddCustomer
    {
        if ($Email !== null) {
            Validator::validateEmail($Email);
        }

        $this->Email = $Email;
        return $this;
    }

    public function setPhone(?string $Phone): AddCustomer
    {
        if ($Phone !== null) {
            Validator::validatePhone($Phone);
        }

        $this->Phone = $Phone;
        return $this;
    }

    public function setIP(?string $IP): AddCustomer
    {
        if ($IP !== null) {
            Validator::validateIp($IP);
        }

        $this->IP = $IP;
        return $this;
    }
}