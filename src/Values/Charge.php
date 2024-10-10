<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class Charge extends Value
{
    /**
     * Идентификатор платежа в системе банка
     *
     * @var int
     */
    protected int $PaymentId;

    /**
     * Идентификатор автоплатежа
     *
     * @var int
     */
    protected int $RebillId;

    /**
     * Получение покупателем уведомлений на электронную почту
     *
     * @var bool
     */
    protected bool $SendEmail = false;

    /**
     * Электронная почта покупателя
     *
     * @var string|null
     */
    protected ?string $InfoEmail = null;

    /**
     * IP-адрес покупателя
     *
     * @var string|null
     */
    protected ?string $IP = null;

    public function __construct(int $PaymentId, int $RebillId)
    {
        $this->setPaymentId($PaymentId);
        $this->setRebillId($RebillId);
    }

    public static function make(int $PaymentId, int $RebillId): Charge
    {
        return new static($PaymentId, $RebillId);
    }

    public function setPaymentId(int $PaymentId): Charge
    {
        $this->PaymentId = $PaymentId;
        return $this;
    }

    public function setRebillId(int $RebillId): Charge
    {
        $this->RebillId = $RebillId;
        return $this;
    }

    public function setSendEmail(bool $SendEmail): Charge
    {
        $this->SendEmail = $SendEmail;
        return $this;
    }

    public function setInfoEmail(?string $InfoEmail): Charge
    {
        if ($InfoEmail !== null) {
            Validator::validateEmail($InfoEmail);
        }

        $this->InfoEmail = $InfoEmail;
        return $this;
    }

    public function setIP(?string $IP): Charge
    {
        if ($IP !== null) {
            Validator::validateIp($IP);
        }

        $this->IP = $IP;
        return $this;
    }
}