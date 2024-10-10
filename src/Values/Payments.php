<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class Payments
{
    /**
     * Вид оплаты "Наличные". Сумма к оплате в копейках не более 14 знаков.
     *
     * @var int|null
     */
    protected ?int $Cash = null;

    /**
     * Вид оплаты "Безналичный".
     *
     * @var int
     */
    protected int $Electronic;

    /**
     * Вид оплаты "Предварительная оплата (Аванс)".
     *
     * @var int|null
     */
    protected ?int $AdvancePayment = null;

    /**
     * Вид оплаты "Постоплата (Кредит)"
     *
     * @var int|null
     */
    protected ?int $Credit = null;

    /**
     * Вид оплаты "Иная форма оплаты".
     *
     * @var int|null
     */
    protected ?int $Provision = null;

    public function __construct(int $Electronic)
    {
        $this->setElectronic($Electronic);
    }

    public static function make(int $Electronic): Payments
    {
        return new static($Electronic);
    }

    public function setCash(?int $Cash): Payments
    {
        if ($Cash !== null) {
            Validator::validatePositiveNumber($Cash);
        }

        $this->Cash = $Cash;
        return $this;
    }

    public function setElectronic(int $Electronic): Payments
    {
        Validator::validatePositiveNumber($Electronic);

        $this->Electronic = $Electronic;
        return $this;
    }

    public function setAdvancePayment(?int $AdvancePayment): Payments
    {
        if ($AdvancePayment !== null) {
            Validator::validatePositiveNumber($AdvancePayment);
        }

        $this->AdvancePayment = $AdvancePayment;
        return $this;
    }

    public function setCredit(?int $Credit): Payments
    {
        if ($Credit !== null) {
            Validator::validatePositiveNumber($Credit);
        }

        $this->Credit = $Credit;
        return $this;
    }

    public function setProvision(?int $Provision): Payments
    {
        if ($Provision !== null) {
            Validator::validatePositiveNumber($Provision);
        }

        $this->Provision = $Provision;
        return $this;
    }
}