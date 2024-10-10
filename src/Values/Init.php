<?php

namespace Arekaev\TbankPayment\Values;

use DateTimeInterface;
use Arekaev\TbankPayment\Enums\Language;
use Arekaev\TbankPayment\Enums\PayType;
use Arekaev\TbankPayment\Validators\Validator;

class Init extends Value
{
    /**
     * Сумма в копейках
     *
     * @var int|null
     */
    protected ?int $Amount = null;

    /**
     * Идентификатор заказа в системе продавца
     *
     * @var string
     */
    protected string $OrderId;

    /**
     * IP-адрес покупателя
     *
     * @var string|null
     */
    protected ?string $IP = null;

    /**
     * Описание заказа
     *
     * @var string|null
     */
    protected ?string $Description = null;

    /**
     * Язык платежной формы
     *
     * Если не передан, форма откроется на русском языке
     *
     * @see \Arekaev\TbankPayment\Enums\Language
     *
     * @var string|null
     */
    protected ?string $Language = null;

    /**
     * Идентификатор родительского платежа
     *
     * Для регистрации автоплатежа
     *
     * @var string|null
     */
    protected ?string $Recurrent = null;

    /**
     * Идентификатор покупателя в системе продавца. Передается вместе с параметром CardId.
     * {@link https://www.tbank.ru/kassa/develop/api/autopayments/getcardlist-description/ См. метод GetCardList}
     *
     * Также необходим для сохранения карт на платежной форме (платежи в один клик).
     *
     * Параметр обязательный если передан параметр Recurrent
     *
     * @var string|null
     */
    protected ?string $CustomerKey = null;

    /**
     * Срок жизни ссылки (не более 90 дней)
     *
     * Временная метка по стандарту ISO8601 в формате YYYY-MM-DDThh:mm:ss±hh:mm
     *
     * Если не передан, принимает значение 24 часа для платежа и 30 дней для счёта
     *
     * @var string|null
     */
    protected ?string $RedirectDueDate = null;

    /**
     * Адрес для получения http нотификаций
     *
     * Если не передан, принимает значение, указанное в настройках терминала
     *
     * @var string|null
     */
    protected ?string $NotificationURL = null;

    /**
     * Страница успеха
     *
     * Если не передан, принимает значение, указанное в настройках терминала
     *
     * @var string|null
     */
    protected ?string $SuccessURL = null;

    /**
     * Страница ошибки
     *
     * Если не передан, принимает значение, указанное в настройках терминала
     *
     * @var string|null
     */
    protected ?string $FailURL = null;

    /**
     * Тип оплаты
     *
     * @see \Arekaev\TbankPayment\Enums\PayType
     *
     * @var string|null
     */
    protected ?string $PayType = null;

    /**
     * Массив данных чека.
     *
     * @see \Arekaev\TbankPayment\Values\Receipt
     *
     * @var Receipt|null
     */
    protected ?Receipt $Receipt = null;

    /**
     * Дополнительные параметры платежа в формате "ключ":"значение" (не более 20 пар). Наименование самого параметра должно быть в
     * верхнем регистре, иначе его содержимое будет игнорироваться.
     *
     * 1. Если у терминала включена опция привязки покупателя после успешной оплаты и передается параметр CustomerKey, то в
     * передаваемых параметрах DATA могут присутствовать параметры метода AddCustomer. Если они присутствуют, то автоматически
     * привязываются к покупателю. Например, если указать: "DATA":{"Phone":"+71234567890", "Email":"a@test.com"}, к покупателю
     * автоматически будут привязаны данные Email и телефон, и они будут возвращаться при вызове метода GetCustomer.
     *
     * 2. Если используется функционал сохранения карт на платежной форме, то при помощи опционального параметра "DefaultCard" можно
     * задать какая карта будет выбираться по умолчанию. Возможные варианты: Оставить платежную форму пустой. Пример:
     * "DATA":{"DefaultCard":"none"}; Заполнить данными передаваемой карты. В этом случае передается CardId. Пример:
     * "DATA":{"DefaultCard":"894952"}; Заполнить данными последней сохраненной карты. Применяется, если параметр "DefaultCard" не
     * передан, передан с некорректным значением или в значении null.
     *
     * @var array|null
     */
    protected ?array $DATA = null;

    public function __construct(string $OrderId)
    {
        $this->setOrderId($OrderId);
    }

    public static function make(string $OrderId): Init
    {
        return new static($OrderId);
    }

    public function setAmount(?int $Amount): Init
    {
        if ($Amount !== null) {
            Validator::validatePositiveNumber($Amount);
        }

        $this->Amount = $Amount;
        return $this;
    }

    public function setOrderId(string $OrderId): Init
    {
        $this->OrderId = $OrderId;
        return $this;
    }

    public function setIP(?string $IP): Init
    {
        if ($IP !== null) {
            Validator::validateIp($IP);
        }

        $this->IP = $IP;
        return $this;
    }

    public function setDescription(?string $Description): Init
    {
        $this->Description = $Description;
        return $this;
    }

    public function setLanguage(?string $Language): Init
    {
        if ($Language !== null) {
            Validator::validateEnum($Language, Language::class);
        }

        $this->Language = $Language;
        return $this;
    }

    public function setRecurrent(?bool $Recurrent): Init
    {
        $this->Recurrent = $Recurrent ? 'Y' : null;
        return $this;
    }

    public function setCustomerKey(?string $CustomerKey): Init
    {
        $this->CustomerKey = $CustomerKey;
        return $this;
    }

    public function setRedirectDueDate(?string $RedirectDueDate): Init
    {
        if ($RedirectDueDate !== null) {
            Validator::validateDateFormat($RedirectDueDate, DateTimeInterface::ISO8601);
        }

        $this->RedirectDueDate = $RedirectDueDate;
        return $this;
    }

    public function setNotificationURL(?string $NotificationURL): Init
    {
        if ($NotificationURL !== null) {
            Validator::validateURL($NotificationURL);
        }

        $this->NotificationURL = $NotificationURL;
        return $this;
    }

    public function setSuccessURL(?string $SuccessURL): Init
    {
        if ($SuccessURL !== null) {
            Validator::validateURL($SuccessURL);
        }

        $this->SuccessURL = $SuccessURL;
        return $this;
    }

    public function setFailURL(?string $FailURL): Init
    {
        if ($FailURL !== null) {
            Validator::validateURL($FailURL);
        }

        $this->FailURL = $FailURL;
        return $this;
    }

    public function setPayType(?string $PayType): Init
    {
        if ($PayType !== null) {
            Validator::validateEnum($PayType, PayType::class);
        }

        $this->PayType = $PayType;
        return $this;
    }

    public function setReceipt(?Receipt $Receipt): Init
    {
        $this->Receipt = $Receipt;
        return $this;
    }

    public function setData(?array $DATA): Init
    {
        $this->DATA = $DATA;
        return $this;
    }

}