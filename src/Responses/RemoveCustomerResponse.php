<?php

namespace Arekaev\TbankPayment\Responses;

class RemoveCustomerResponse extends BaseResponse
{
    /**
     * Идентификатор покупателя в системе продавца
     *
     * @var string
     */
    protected string $CustomerKey;

    public function getCustomerKey(): string
    {
        return $this->CustomerKey;
    }
}