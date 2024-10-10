<?php

namespace Arekaev\TbankPayment\Responses;

class RemoveCardResponse extends BaseResponse
{
    /**
     * Идентификатор покупателя в системе продавца
     *
     * @var string
     */
    protected string $CustomerKey;

    /**
     * Идентификатор карты в системе Банка
     *
     * @var string
     */
    protected string $CardId;

    /**
     * Статус карты: D – удалена
     *
     * @var string
     */
    protected string $Status;

    /**
     * Тип карты:
     * 1. карта списания
     * 2. карта пополнения
     * 3. карта пополнения и списания
     *
     * @var string
     */
    protected string $CardType;
}