<?php

namespace Arekaev\TbankPayment\Values;

class SendClosingReceipt extends Value
{
    /**
     * Идентификатор платежа в системе банка
     *
     * @var int
     */
    protected int $PaymentId;

    /**
     * Массив данных чека
     *
     * @var Receipt
     */
    protected Receipt $Receipt;


    public function setPaymentId(int $PaymentId): SendClosingReceipt
    {
        $this->PaymentId = $PaymentId;
        return $this;
    }

    public function setReceipt(Receipt $Receipt): SendClosingReceipt
    {
        $this->Receipt = $Receipt;
        return $this;
    }
}