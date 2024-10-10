<?php

namespace Arekaev\TbankPayment\Responses;

class GetCustomerResponse extends BaseResponse
{
    /**
     * Идентификатор покупателя в системе продавца
     *
     * @var string
     */
    protected string $CustomerKey;

    /**
     * Электронная почта покупателя
     *
     * @var string|null
     */
    protected ?string $Email = null;

    /**
     * Телефон покупателя
     *
     * В формате +71234567890
     *
     * @var string|null
     */
    protected ?string $Phone = null;


    public function getCustomerKey(): string
    {
        return $this->CustomerKey;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function getPhone(): ?string
    {
        return $this->Phone;
    }
}