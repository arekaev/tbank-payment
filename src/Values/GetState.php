<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class GetState extends Value
{
    /**
     * Идентификатор платежа в системе банка
     *
     * @var int
     */
    protected int $PaymentId;

    /**
     * IP-адрес покупателя
     *
     * @var string|null
     */
    protected ?string $IP = null;

    public function __construct(int $PaymentId)
    {
        $this->setPaymentId($PaymentId);
    }

    public static function make(int $PaymentId): GetState
    {
        return new static($PaymentId);
    }

    public function setPaymentId(int $PaymentId): GetState
    {
        $this->PaymentId = $PaymentId;
        return $this;
    }

    public function setIP(?string $IP): GetState
    {
        if ($IP !== null) {
            Validator::validateIp($IP);
        }

        $this->IP = $IP;
        return $this;
    }
}