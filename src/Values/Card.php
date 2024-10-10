<?php

namespace Arekaev\TbankPayment\Values;

class Card extends Value
{
    /**
     * Идентификатор сохраненной карты в системе банка
     *
     * @var string
     */
    protected string $CardId;

    /**
     * Замаскированный номер карты
     *
     * @var string
     */
    protected string $Pan;

    /**
     * Срок действия карты
     *
     * @var string
     */
    protected string $ExpDate;

    /**
     * Тип карты
     *
     * @see \Arekaev\TbankPayment\Enums\CardType
     *
     * @var string
     */
    protected string $CardType;

    /**
     * Статус карты
     *
     * @see \Arekaev\TbankPayment\Enums\CardStatus
     *
     * @var string
     */
    protected string $Status;

    /**
     * Идентификатор автоплатежа
     *
     * @var string|null
     */
    protected ?string $RebillId = null;


    public function __construct(
        string $CardId,
        string $Pan,
        string $ExpDate,
        string $CardType,
        string $Status,
        ?string $RebillId = null
    )
    {
        $this->CardId = $CardId;
        $this->Pan = $Pan;
        $this->ExpDate = $ExpDate;
        $this->CardType = $CardType;
        $this->Status = $Status;
        $this->RebillId = $RebillId;
    }

    public function getCardId(): string
    {
        return $this->CardId;
    }

    public function getPan(): string
    {
        return $this->Pan;
    }

    public function getExpDate(): string
    {
        return $this->ExpDate;
    }

    public function getCardType(): string
    {
        return $this->CardType;
    }

    public function getStatus(): string
    {
        return $this->Status;
    }

    public function getRebillId(): ?string
    {
        return $this->RebillId;
    }
}