<?php

namespace Arekaev\TbankPayment\Responses;

class ConfirmResponse extends BaseResponse
{
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
     * @var int
     */
    protected int $PaymentId;


    public function getOrderId(): string
    {
        return $this->OrderId;
    }

    public function getStatus(): string
    {
        return $this->Status;
    }

    public function getPaymentId(): int
    {
        return $this->PaymentId;
    }
}