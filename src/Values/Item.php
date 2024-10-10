<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Enums\PaymentMethod;
use Arekaev\TbankPayment\Enums\PaymentObject;
use Arekaev\TbankPayment\Enums\Tax;
use Arekaev\TbankPayment\Validators\Validator;

class Item extends Value
{
    /**
     * Наименование товара
     *
     * @var string
     */
    protected string $Name;

    /**
     * Количество или вес товара
     *
     * @var int
     */
    protected int $Quantity;

    /**
     * Стоимость товара в копейках
     *
     * Произведение Quantity и Price
     *
     * @var int
     */
    protected int $Amount;

    /**
     * Цена за единицу товара в копейках
     *
     * @var int
     */
    protected int $Price;

    /**
     * Признак способа расчета
     *
     * @see \Arekaev\TbankPayment\Enums\PaymentMethod
     *
     * @var string|null
     */
    protected ?string $PaymentMethod = null;

    /**
     * Признак предмета расчета
     *
     * Если не передан, в кассу отправляется значение commodity
     *
     * @see \Arekaev\TbankPayment\Enums\PaymentObject
     *
     * @var string|null
     */
    protected ?string $PaymentObject = null;

    /**
     * Ставка НДС
     *
     * @see \Arekaev\TbankPayment\Enums\Tax
     *
     * @var string
     */
    protected string $Tax;

    /**
     * Штрих-код в требуемом формате. В зависимости от типа кассы требования могут отличаться:
     *
     * 1. АТОЛ Онлайн - шестнадцатеричное представление с пробелами. Максимальная длина – 32 байта. Пример: 00 00 00 01 00 21 FA 41 00
     * 23 05 41 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 00 12 00 AB 00
     * 2. CloudKassir - длина строки: четная, от 8 до 150 байт, т.е. от 16 до 300 ASCII символов ['0' - '9' , 'A' - 'F' ]
     * шестнадцатеричного представления кода маркировки товара. Пример: 303130323930303030630333435
     * 3. OrangeData - строка, содержащая base64 кодированный массив от 8 до 32 байт. Пример: igQVAAADMTIzNDU2Nzg5MDEyMwAAAAAAAQ==
     *
     * В случае передачи в запросе параметра Ean13 не прошедшего валидацию, возвращается неуспешный ответ с текстом ошибки в параметре
     * message = "Неверный параметр Ean13". Валидация параметра Ean13 необходима как в объекте Receipt, так и в объекте Receipts.
     *
     * @var string|null
     */
    protected ?string $Ean13 = null;

    /**
     * Данные агента
     *
     * Используется при работе по агентской схеме
     *
     * @see \Arekaev\TbankPayment\Values\AgentData
     *
     * @var AgentData|null
     */
    protected ?AgentData $AgentData = null;

    /**
     * Данные поставщика платежного агента
     *
     * Обязательный, если передается значение AgentSign в объекте AgentData
     *
     * @see \Arekaev\TbankPayment\Values\SupplierInfo
     *
     * @var SupplierInfo|null
     */
    protected ?SupplierInfo $SupplierInfo = null;

    public function __construct(string $Name, int $Quantity, int $Amount, int $Price, string $Tax)
    {
        $this->setName($Name);
        $this->setQuantity($Quantity);
        $this->setAmount($Amount);
        $this->setPrice($Price);
        $this->setTax($Tax);
    }

    public static function make(string $Name, int $Quantity, int $Amount, int $Price, string $Tax): Item
    {
        return new static($Name, $Quantity, $Amount, $Price, $Tax);
    }

    public function setName(string $Name): Item
    {
        $this->Name = $Name;
        return $this;
    }

    public function setQuantity(int $Quantity): Item
    {
        Validator::validatePositiveNumber($Quantity);

        $this->Quantity = $Quantity;
        return $this;
    }

    public function setAmount(int $Amount): Item
    {
        Validator::validatePositiveNumber($Amount);

        $this->Amount = $Amount;
        return $this;
    }

    public function setPrice(int $Price): Item
    {
        Validator::validatePositiveNumber($Price);

        $this->Price = $Price;
        return $this;
    }

    public function setPaymentMethod(?string $PaymentMethod): Item
    {
        if ($PaymentMethod !== null) {
            Validator::validateEnum($PaymentMethod, PaymentMethod::class);
        }

        $this->PaymentMethod = $PaymentMethod;
        return $this;
    }

    public function setPaymentObject(?string $PaymentObject): Item
    {
        if ($PaymentObject !== null) {
            Validator::validateEnum($PaymentObject, PaymentObject::class);
        }

        $this->PaymentObject = $PaymentObject;
        return $this;
    }

    public function setTax(string $Tax): Item
    {
        Validator::validateEnum($Tax, Tax::class);

        $this->Tax = $Tax;
        return $this;
    }

    public function setEan13(?string $Ean13): Item
    {
        $this->Ean13 = $Ean13;
        return $this;
    }

    public function setAgentData(?AgentData $AgentData): Item
    {
        $this->AgentData = $AgentData;
        return $this;
    }

    public function setSupplierInfo(?SupplierInfo $SupplierInfo): Item
    {
        $this->SupplierInfo = $SupplierInfo;
        return $this;
    }

}