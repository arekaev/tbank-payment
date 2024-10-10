<?php

namespace Arekaev\TbankPayment\Enums;

class CardType extends Enum
{
    /**
     * Карта списания
     */
    public const WRITE_OFF = 0;

    /**
     * Карта пополнения
     */
    public const RECHARGE = 1;

    /**
     * Карта списания и пополнения
     */
    public const WRITE_OFF_AND_RECHARGE = 2;
}