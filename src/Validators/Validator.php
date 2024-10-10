<?php

namespace Arekaev\TbankPayment\Validators;

use DateTime;
use Exception;
use Arekaev\TbankPayment\Enums\Enum;
use Arekaev\TbankPayment\Exceptions\ValidationException;

class Validator
{
    public static function validateEnum($value, string $enumClass)
    {
        if (!is_subclass_of($enumClass, Enum::class) || !$enumClass::isValid($value)) {
            throw new ValidationException("Given value is not a constant of $enumClass");
        }
    }

    public static function validateEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("Given value is not an valid email");
        }
    }

    public static function validatePhone($value)
    {
        if (!preg_match('/^\+\d+$/', $value)) {
            throw new ValidationException("Given value is not a correct phone number");
        }
    }

    public static function validatePhones($value)
    {
        foreach ((array)$value as $item) {
            self::validatePhone($item);
        }
    }

    public static function validatePositiveNumber($value)
    {
        if (!is_numeric($value) || $value <= 0) {
            throw new ValidationException("Given value must be greater than 0");
        }
    }

    public static function validateIp($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_IP)) {
            throw new ValidationException("Given value is not an valid IP");
        }
    }

    public static function validateDateFormat($value, string $format)
    {
        try {
            if ((new DateTime($value))->format($format) !== $value) {
                throw new Exception();
            }
        } catch (Exception $e) {
            throw new ValidationException("Given value has invalid date format");
        }
    }

    public static function validateURL($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new ValidationException("Given value is not a valid url");
        }
    }

    public static function validateInstances($value, $needClass)
    {
        foreach ((array)$value as $item) {
            if (get_class($item) !== $needClass) {
                throw new ValidationException("Given value must be array of $needClass instances");
            }
        }
    }
}