<?php

namespace App\Helpers;

use InvalidArgumentException;

class ExchangeRateHelper
{
    const CURRENCIES = ["EUR", "GBP", "NGN", "USD"];

    public static function getRatesForCurrency(string $currency): array
    {
        $currencies = self::CURRENCIES;

        $index = array_search($currency, $currencies);

        if ($index === false) {
            throw new InvalidArgumentException("Unsupported currency provided");
        }

        array_splice($currencies, $index, 1);

        $rates = [];

        foreach ($currencies as $currency) {
            $rates[$currency] = 1;
        }

        return $rates;
    }

    public static function getAllRates(): array
    {
        $rates = [];
        foreach (self::CURRENCIES as $currency) {
            $rates[$currency] = self::getRatesForCurrency($currency);
        }
        return $rates;
    }

    public static function getSupportedCurrencies(): array
    {
        return self::CURRENCIES;
    }
}
