<?php

namespace Arekaev\TbankPayment\Exceptions;

class TbankPaymentRequestException extends TbankPaymentException
{
    protected string  $errorCode;
    protected ?string $errorMessage = null;
    protected ?string $errorDetails = null;

    public function __construct(string $errorCode, ?string $errorMessage = null, ?string $errorDetails = null)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->errorDetails = $errorDetails;

        parent::__construct($this->buildExceptionMessage());
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function getErrorDetails(): ?string
    {
        return $this->errorDetails;
    }

    private function buildExceptionMessage(): string
    {
        $messageParts = [
            'TbankPayment API request error.',
            "Code: $this->errorCode.",
        ];

        if ($this->errorMessage) {
            $messageParts[] = "Message: $this->errorMessage";
        }

        if ($this->errorDetails) {
            $messageParts[] = "Details: $this->errorDetails";
        }

        return implode(' ', $messageParts);
    }
}