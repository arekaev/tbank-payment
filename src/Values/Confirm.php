<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class Confirm extends Value
{
    /**
     * Идентификатор платежа в системе банка
     *
     * @var int
     */
    public int $PaymentId;

    /**
     * Сумма в копейках
     *
     * @var int|null
     */
    public ?int $Amount = null;

    /**
     * IP-адрес покупателя
     *
     * @var string|null
     */
    public ?string $IP = null;

    /**
     * Массив данных чека
     *
     * Имеет приоритет над данными, переданными в методе Init
     *
     * @var Receipt|null
     */
    public ?Receipt $Receipt = null;

    public function __construct(int $PaymentId)
    {
        $this->setPaymentId($PaymentId);
    }

    public static function make(int $PaymentId): Confirm
    {
        return new static($PaymentId);
    }

    public function setPaymentId(int $PaymentId): Confirm
    {
        $this->PaymentId = $PaymentId;
        return $this;
    }


    public function setAmount(?int $Amount): Confirm
    {
        if ($Amount !== null) {
            Validator::validatePositiveNumber($Amount);
        }

        $this->Amount = $Amount;
        return $this;
    }


    public function setIP(?string $IP): Confirm
    {
        if ($IP !== null) {
            Validator::validateIp($IP);
        }

        $this->IP = $IP;
        return $this;
    }


    public function setReceipt(?Receipt $Receipt): Confirm
    {
        $this->Receipt = $Receipt;
        return $this;
    }
}