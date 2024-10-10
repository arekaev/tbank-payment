<?php

namespace Arekaev\TbankPayment\Enums;

class AgentSign extends Enum
{
    /**
     * Банковский платежный агент
     */
    public const BANK_PAYING_AGENT = 'bank_paying_agent';

    /**
     * Банковский платежный субагент
     */
    public const BANK_PAYING_SUBAGENT = 'bank_paying_subagent';

    /**
     * Платежный агент
     */
    public const PAYING_AGENT = 'paying_agent';

    /**
     * Платежный субагент
     */
    public const PAYING_SUBAGENT = 'paying_subagent';

    /**
     * Поверенный
     */
    public const ATTORNEY = 'attorney';

    /**
     * Комиссионер
     */
    public const COMMISSION_AGENT = 'commission_agent';

    /**
     * Другой тип агента
     */
    public const ANOTHER = 'another';
}