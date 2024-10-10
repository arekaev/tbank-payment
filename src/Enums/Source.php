<?php

namespace Arekaev\TbankPayment\Enums;

class Source extends Enum
{
    public const CARDS      = 'Cards';
    public const APPLE_PAY  = 'ApplePay';
    public const GOOGLE_PAY = 'GooglePay';
}