<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class Cancel extends Value
{
    /**
     * Идентификатор платежа в системе банка
     *
     * @var int
     */
    protected int $PaymentId;

    /**
     * Сумма возврата в копейках
     *
     * @var int|null
     */
    protected ?int $Amount = null;

    /**
     * IP-адрес покупателя
     *
     * @var string|null
     */
    protected ?string $IP = null;

    /**
     * Массив данных чека
     *
     * @var Receipt|null
     */
    protected ?Receipt $Receipt = null;


    public function __construct(int $PaymentId)
    {
        $this->setPaymentId($PaymentId);
    }

    public static function make(int $PaymentId): Cancel
    {
        return new static($PaymentId);
    }

    public function setPaymentId(int $PaymentId): Cancel
    {
        $this->PaymentId = $PaymentId;
        return $this;
    }

    public function setAmount(?int $Amount): Cancel
    {
        if ($Amount !== null) {
            Validator::validatePositiveNumber($Amount);
        }

        $this->Amount = $Amount;
        return $this;
    }

    public function setIP(?string $IP): Cancel
    {
        if ($IP !== null) {
            Validator::validateIp($IP);
        }

        $this->IP = $IP;
        return $this;
    }

    public function setReceipt(?Receipt $Receipt): Cancel
    {
        $this->Receipt = $Receipt;
        return $this;
    }
}