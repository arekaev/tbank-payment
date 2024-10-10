<?php

namespace Arekaev\TbankPayment\Values;

use Arekaev\TbankPayment\Validators\Validator;

class SupplierInfo
{
    /**
     * Телефон поставщика
     *
     * Обязательный, если передается значение AgentSign в объекте AgentData
     *
     * @var array|null
     */
    protected ?array $Phones = null;

    /**
     * Наименование поставщика
     *
     * Внимание: в данные 239 символов включаются телефоны поставщика + 4 символа на каждый телефон.
     * Например, если передано два телефона поставщика длиной 12 и 14 символов, то максимальная длина наименования поставщика будет
     * 239 – (12 + 4) – (14 + 4) = 205 символов
     *
     * Обязательный, если передается значение AgentSign в объекте AgentData
     *
     * @var string|null
     */
    protected ?string $Name = null;

    /**
     * ИНН поставщика
     *
     * Строка длиной 10 или 12 символов, формат ЦЦЦЦЦЦЦЦЦЦ
     *
     * Обязательный, если передается значение AgentSign в объекте AgentData
     *
     * @var string|null
     */
    protected ?string $Inn = null;

    public function setPhones(?array $Phones): SupplierInfo
    {
        if ($Phones !== null) {
            Validator::validatePhones($Phones);
        }

        $this->Phones = $Phones;
        return $this;
    }

    public function setName(?string $Name): SupplierInfo
    {
        $this->Name = $Name;
        return $this;
    }

    public function setInn(?string $Inn): SupplierInfo
    {
        $this->Inn = $Inn;
        return $this;
    }
}