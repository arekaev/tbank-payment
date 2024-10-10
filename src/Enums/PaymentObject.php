<?php

namespace Arekaev\TbankPayment\Enums;

class PaymentObject extends Enum
{

    /**
     * Товар
     */
    public const COMMODITY = 'commodity';

    /**
     * Подакцизный товар
     */
    public const EXCISE = 'excise';

    /**
     * Работа
     */
    public const JOB = 'job';

    /**
     * Услуга
     */
    public const SERVICE = 'service';

    /**
     * Ставка азартной игры
     */
    public const GAMBLING_BET = 'gambling_bet';

    /**
     * Выигрыш азартной игры
     */
    public const GAMBLING_PRIZE = 'gambling_prize';

    /**
     * Лотерейный билет
     */
    public const LOTTERY = 'lottery';

    /**
     * Выигрыш лотереи
     */
    public const LOTTERY_PRIZE = 'lottery_prize';

    /**
     * Предоставление результатов интеллектуальной деятельности
     */
    public const INTELLECTUAL_ACTIVITY = 'intellectual_activity';

    /**
     * Платеж
     */
    public const PAYMENT = 'payment';

    /**
     * Агентское вознаграждение
     */
    public const AGENT_COMMISSION = 'agent_commission';

    /**
     * Составной предмет расчета
     */
    public const COMPOSITE = 'composite';

    /**
     * Иной предмет расчета
     */
    public const ANOTHER = 'another';
}