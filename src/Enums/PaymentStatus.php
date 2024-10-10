<?php

namespace Arekaev\TbankPayment\Enums;


class PaymentStatus extends Enum
{
    /**
     * Создан
     */
    public const NEW = 'NEW';

    /**
     * Платежная форма открыта покупателем
     */
    public const FORM_SHOWED = 'FORM_SHOWED';

    /**
     * Просрочен
     */
    public const DEADLINE_EXPIRED = 'DEADLINE_EXPIRED';

    /**
     * Отменен
     */
    public const CANCELED = 'CANCELED';

    /**
     * Проверка платежных данных
     */
    public const PREAUTHORIZING = 'PREAUTHORIZING';

    /**
     * Резервируется
     */
    public const AUTHORIZING = 'AUTHORIZING';

    /**
     * Зарезервирован
     */
    public const AUTHORIZED = 'AUTHORIZED';

    /**
     * Не прошел авторизацию
     */
    public const AUTH_FAIL = 'AUTH_FAIL';

    /**
     * Отклонен
     */
    public const REJECTED = 'REJECTED';


    /**
     * Проверяется по протоколу 3-D Secure
     */
    public const CHECKING_3DS = '3DS_CHECKING';

    /**
     * Проверен по протоколу 3-D Secure
     */
    public const CHECKED_3DS = '3DS_CHECKED';

    /**
     * Резервирование отменяется
     */
    public const REVERSING = 'REVERSING';

    /**
     * Резервирование отменено частично
     */
    public const PARTIAL_REVERSED = 'PARTIAL_REVERSED';

    /**
     * Резервирование отменено
     */
    public const REVERSED = 'REVERSED';

    /**
     * Подтверждается
     */
    public const CONFIRMING = 'CONFIRMING';

    /**
     * Подтвержден
     */
    public const CONFIRMED = 'CONFIRMED';

    /**
     * Возвращается
     */
    public const REFUNDING = 'REFUNDING';

    /**
     * Возвращен частично
     */
    public const PARTIAL_REFUNDED = 'PARTIAL_REFUNDED';

    /**
     * Возвращен полностью
     */
    public const REFUNDED = 'REFUNDED';
}