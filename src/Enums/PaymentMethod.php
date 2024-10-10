<?php

namespace Arekaev\TbankPayment\Enums;

class PaymentMethod extends Enum
{
    /**
     *  Полный расчет
     */
    public const FULL_PAYMENT = 'full_payment';

    /**
     *  Предоплата 100%
     */
    public const FULL_PREPAYMENT = 'full_prepayment';

    /**
     *  Предоплата
     */
    public const PREPAYMENT = 'prepayment';

    /**
     *  Аванс
     */
    public const ADVANCE = 'advance';

    /**
     *  Частичный расчет и кредит
     */
    public const PARTIAL_PAYMENT = 'partial_payment';

    /**
     *  Передача в кредит
     */
    public const CREDIT = 'credit';

    /**
     *  Оплата кредита
     */
    public const CREDIT_PAYMENT = 'credit_payment';
}