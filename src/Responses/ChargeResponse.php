<?php

namespace Arekaev\TbankPayment\Responses;

use Arekaev\TbankPayment\Enums\PaymentStatus;

class ChargeResponse extends BaseResponse
{
    /**
     * Сумма в копейках
     *
     * @var int
     */
    protected int $Amount;

    /**
     * Идентификатор заказа в системе продавца
     *
     * @var string
     */
    protected string $OrderId;

    /**
     * Статус платежа
     *
     * @see PaymentStatus
     *
     * @var string
     */
    protected string $Status;

    /**
     * Уникальный идентификатор транзакции в системе банка
     *
     * @var string
     */
    protected string $PaymentId;


    public function getAmount(): int
    {
        return $this->Amount;
    }

    public function getOrderId(): string
    {
        return $this->OrderId;
    }

    public function getStatus(): string
    {
        return $this->Status;
    }

    public function getPaymentId(): string
    {
        return $this->PaymentId;
    }
}