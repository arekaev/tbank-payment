<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Enums\Taxation;
use Arekaev\TbankPayment\Validators\Validator;

class Receipt extends Value
{
    /**
     * Электронная почта покупателя
     *
     * Необязательный, если передан параметр Phone
     *
     * @var string|null
     */
    protected ?string $Email = null;

    /**
     * Телефон покупателя
     *
     * В формате +{Ц}
     *
     * Необязательный, если передан параметр Email
     *
     * @var string|null
     */
    protected ?string $Phone = null;

    /**
     * Электронная почта продавца
     *
     * @var string|null
     */
    protected ?string $EmailCompany = null;

    /**
     * Система налогообложения
     *
     * @see \Arekaev\TbankPayment\Enums\Taxation
     *
     * @var string|null
     */
    protected ?string $Taxation = null;

    /**
     * Массив позиций чека с информацией о товарах.
     *
     * @see \Arekaev\TbankPayment\Values\Item
     *
     * @var array<Item>
     */
    protected array $Items;

    /**
     * Объект с информацией о видах оплаты заказа.
     *
     * @see \Arekaev\TbankPayment\Values\Payments
     *
     * @var Payments|null
     */
    protected ?Payments $Payments = null;


    public function __construct(array $Items)
    {
        $this->setItems($Items);
    }

    public static function make(array $Items): Receipt
    {
        return new static($Items);
    }

    public function setEmail(?string $Email): Receipt
    {
        if ($Email !== null) {
            Validator::validateEmail($Email);
        }

        $this->Email = $Email;
        return $this;
    }

    public function setPhone(?string $Phone): Receipt
    {
        if ($Phone !== null) {
            Validator::validatePhone($Phone);
        }

        $this->Phone = $Phone;
        return $this;
    }

    public function setEmailCompany(?string $EmailCompany): Receipt
    {
        if ($EmailCompany !== null) {
            Validator::validateEmail($EmailCompany);
        }

        $this->EmailCompany = $EmailCompany;
        return $this;
    }

    public function setTaxation(?string $Taxation): Receipt
    {
        if ($Taxation !== null) {
            Validator::validateEnum($Taxation, Taxation::class);
        }

        $this->Taxation = $Taxation;
        return $this;
    }

    public function setItems(array $Items): Receipt
    {
        Validator::validateInstances($Items, Item::class);

        $this->Items = $Items;
        return $this;
    }

    public function setPayments(?Payments $Payments): Receipt
    {
        $this->Payments = $Payments;
        return $this;
    }
}