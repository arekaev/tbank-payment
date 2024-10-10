<?php

namespace Arekaev\TbankPayment\Responses;

use Arekaev\TbankPayment\Exceptions\TbankPaymentRequestException;
use Arekaev\TbankPayment\Helpers\Arr;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;

abstract class BaseResponse
{
    /**
     * Идентификатор терминала. Выдается продавцу банком при заведении терминала
     *
     * @var string
     */
    protected string $TerminalKey;

    /**
     * Успешность операции
     *
     * @var bool
     */
    protected bool $Success = false;

    /**
     * @param ResponseInterface $response
     *
     * @throws TbankPaymentRequestException
     */
    public function __construct(ResponseInterface $response)
    {
        $response = json_decode($response->getBody()->getContents(), true);

        $this->parseError($response);
        $this->parseResponse($response);
    }

    public function getTerminalKey(): string
    {
        return $this->TerminalKey;
    }

    public function getSuccess(): bool
    {
        return $this->Success;
    }

    protected function parseError($response)
    {
        $this->Success = Arr::get($response, 'Success', true);
        
        if ($this->Success === false) {
            $code = Arr::get($response, 'ErrorCode');
            $errorMessage = Arr::get($response, 'Message');
            $errorDetails = Arr::get($response, 'Details');

            throw new TbankPaymentRequestException($code, $errorMessage, $errorDetails);
        }
    }

    protected function parseResponse(array $response)
    {
        foreach ((new ReflectionClass($this))->getProperties() as $property) {
            if (!$property->isPrivate()) {
                $name = $property->getName();

                if (Arr::has($response, $name)) {
                    $this->$name = Arr::get($response, $name);
                }
            }
        }
    }
}