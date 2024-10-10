<?php

namespace Arekaev\TbankPayment\Responses;

class InitResponse extends BaseResponse
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
     * Идентификатор платежа в системе банка
     *
     * @var string
     */
    protected string $PaymentId;

    /**
     * Ссылка на платежную форму
     *
     * @var string
     */
    protected string $PaymentURL;


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

    public function getPaymentURL(): string
    {
        return $this->PaymentURL;
    }
}