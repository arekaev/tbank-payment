<?php

namespace Arekaev\TbankPayment;

use Arekaev\TbankPayment\Exceptions\TbankPaymentRequestException;
use Arekaev\TbankPayment\Helpers\Arr;
use Arekaev\TbankPayment\Responses\AddCustomerResponse;
use Arekaev\TbankPayment\Responses\CancelResponse;
use Arekaev\TbankPayment\Responses\ChargeResponse;
use Arekaev\TbankPayment\Responses\ConfirmResponse;
use Arekaev\TbankPayment\Responses\GetCardListResponse;
use Arekaev\TbankPayment\Responses\GetCustomerResponse;
use Arekaev\TbankPayment\Responses\GetStateResponse;
use Arekaev\TbankPayment\Responses\InitResponse;
use Arekaev\TbankPayment\Responses\RemoveCardResponse;
use Arekaev\TbankPayment\Responses\RemoveCustomerResponse;
use Arekaev\TbankPayment\Responses\ResendResponse;
use Arekaev\TbankPayment\Responses\SendClosingReceiptResponse;
use Arekaev\TbankPayment\Values\AddCustomer;
use Arekaev\TbankPayment\Values\Cancel;
use Arekaev\TbankPayment\Values\Charge;
use Arekaev\TbankPayment\Values\Confirm;
use Arekaev\TbankPayment\Values\Customer;
use Arekaev\TbankPayment\Values\GetState;
use Arekaev\TbankPayment\Values\Init;
use Arekaev\TbankPayment\Values\RemoveCard;
use Arekaev\TbankPayment\Values\SendClosingReceipt;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;


class TbankPayment
{
    private ClientInterface $client;
    private string $apiUrl = 'https://securepay.TbankPayment.ru/v2';
    private string $terminalKey;
    private string $password;

    public function __construct(
        ClientInterface $client,
        string $terminalKey,
        string $password,
        string $apiUrl = null
    )
    {
        $this->client = $client;
        $this->terminalKey = $terminalKey;
        $this->password = $password;
        $this->apiUrl = $apiUrl ?: $this->apiUrl;
    }

    /**
     * Метод создает платеж: продавец получает ссылку на платежную форму и должен перенаправить по ней покупателя
     *
     * @param Init $init
     *
     * @return InitResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function init(Init $init): InitResponse
    {
        $response = $this->execute('Init', $init->toArray());

        return new InitResponse($response);
    }

    /**
     * Метод подтверждает платеж и списывает ранее заблокированные средства.
     *
     * Используется при двухстадийной оплате. При одностадийной оплате вызывается автоматически. Применим к платежу только в статусе
     * AUTHORIZED и только один раз.
     *
     * Сумма подтверждения не может быть больше заблокированной. Если сумма подтверждения меньше заблокированной, будет выполнено
     * частичное подтверждение.
     *
     * @param Confirm $confirm
     *
     * @return ConfirmResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function confirm(Confirm $confirm): ConfirmResponse
    {
        $response = $this->execute('Confirm', $confirm->toArray());

        return new ConfirmResponse($response);
    }

    /**
     * Метод отменяет платеж.
     *
     * @param Cancel $cancel
     *
     * @return CancelResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function cancel(Cancel $cancel): CancelResponse
    {
        $response = $this->execute('Cancel', $cancel->toArray());

        return new CancelResponse($response);
    }

    /**
     * Метод возвращает текущий статус платежа.
     *
     * @param GetState $getState
     *
     * @return GetStateResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function getState(GetState $getState): GetStateResponse
    {
        $response = $this->execute('GetState', $getState->toArray());

        return new GetStateResponse($response);
    }

    /**
     * Метод отправляет все неотправленные уведомления.
     *
     * @return ResendResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function resend(): ResendResponse
    {
        $response = $this->execute('Resend');

        return new ResendResponse($response);
    }

    /**
     * Отправляет закрывающий чек в кассу
     *
     * @param SendClosingReceipt $sendClosingReceipt
     *
     * @return SendClosingReceiptResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function sendClosingReceipt(SendClosingReceipt $sendClosingReceipt): SendClosingReceiptResponse
    {
        $response = $this->execute('Resend');

        return new SendClosingReceiptResponse($response);
    }

    /**
     * Метод осуществляет автоплатёж.
     *
     * Всегда работает по типу одностадийной оплаты: во время выполнения метода на Notification URL будет отправлен синхронный запрос,
     * на который требуется корректный ответ.
     *
     * @param Charge $charge
     *
     * @return ChargeResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function charge(Charge $charge): ChargeResponse
    {
        $response = $this->execute('Charge', $charge->toArray());

        return new ChargeResponse($response);
    }

    /**
     * Метод регистрирует покупателя и его данные в системе продавца.
     *
     * @param AddCustomer $addCustomer
     *
     * @return AddCustomerResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function addCustomer(AddCustomer $addCustomer): AddCustomerResponse
    {
        $response = $this->execute('AddCustomer', $addCustomer->toArray());

        return new AddCustomerResponse($response);
    }

    /**
     * Метод возвращает данные покупателя
     *
     * @param Customer $customer
     *
     * @return GetCustomerResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function getCustomer(Customer $customer): GetCustomerResponse
    {
        $response = $this->execute('GetCustomer', $customer->toArray());

        return new GetCustomerResponse($response);
    }

    /**
     * Метод удаляет данные зарегистрированного покупателя.
     *
     * @param Customer $customer
     *
     * @return RemoveCustomerResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function removeCustomer(Customer $customer): RemoveCustomerResponse
    {
        $response = $this->execute('RemoveCustomer', $customer->toArray());

        return new RemoveCustomerResponse($response);
    }

    /**
     * Метод удаляет данные зарегистрированного покупателя.
     *
     * @param Customer $customer
     *
     * @return GetCardListResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function getCardList(Customer $customer): GetCardListResponse
    {
        $response = $this->execute('GetCardList', $customer->toArray());

        return new GetCardListResponse($response);
    }

    /**
     * Метод удаляет данные зарегистрированного покупателя.
     *
     * @param RemoveCard $card
     *
     * @return RemoveCardResponse
     * @throws GuzzleException|TbankPaymentRequestException
     */
    public function removeCard(RemoveCard $card): RemoveCardResponse
    {
        $response = $this->execute('RemoveCard', $card->toArray());

        return new RemoveCardResponse($response);
    }

    /**
     * @param string $action
     * @param array  $body
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    private function execute(string $action, array $body = []): ResponseInterface
    {
        return $this->client->request(
            'POST',
            $this->apiUrl . '/' . ltrim($action, '/'),
            [
                'json' => $this->prepareBody($body),
            ]
        );
    }

    private function prepareBody(array $body): array
    {
        return array_merge($body, [
            'TerminalKey' => $this->terminalKey,
            'Token'       => $this->generateToken($body),
        ]);
    }

    private function generateToken(array $body): string
    {
        $body = Arr::merge(
            Arr::except($body, ['Shops', 'Receipt', 'DATA']),
            [
                'TerminalKey' => $this->terminalKey,
                'Password'    => $this->password,
            ]
        );

        ksort($body);

        return hash('sha256', implode(null, $body));
    }
}