<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class RemoveCard extends Value
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
     * IP-адрес покупателя
     *
     * @var string|null
     */
    protected ?string $IP = null;

    public function __construct(string $CustomerKey, string $CardId)
    {
        $this->setCustomerKey($CustomerKey);
        $this->setCardId($CardId);
    }

    public static function make(string $CustomerKey, string $CardId): RemoveCard
    {
        return new static($CustomerKey, $CardId);
    }

    public function setCustomerKey(string $CustomerKey): RemoveCard
    {
        $this->CustomerKey = $CustomerKey;
        return $this;
    }

    public function setCardId(string $CardId): RemoveCard
    {
        $this->CardId = $CardId;
        return $this;
    }

    public function setIP(?string $IP): RemoveCard
    {
        if ($IP !== null) {
            Validator::validateIp($IP);
        }
        $this->IP = $IP;
        return $this;
    }
}