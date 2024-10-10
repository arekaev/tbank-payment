<?php

namespace Arekaev\TbankPayment\Responses;

class CancelResponse extends BaseResponse
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

    /**
     * Сумма до возврата в копейках
     *
     * @var int
     */
    protected int $OriginalAmount;

    /**
     * Сумма после возврата в копейках
     *
     * @var int
     */
    protected int $NewAmount;


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

    public function getOriginalAmount(): int
    {
        return $this->OriginalAmount;
    }

    public function getNewAmount(): int
    {
        return $this->NewAmount;
    }
}