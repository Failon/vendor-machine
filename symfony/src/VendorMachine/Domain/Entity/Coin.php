<?php

namespace App\VendorMachine\Domain\Entity;

class Coin
{
    private const CURRENCY_TYPES = [0.05, 0.10, 0.25, 1.0];
    private float $value;

    public function __construct(float $value)
    {
        $this->assertValueIsPossitive($value);
        $this->assertValueIsInAcceptableCurrencyRange($value);
        $this->value = $value;
    }

    /**
     * @param float $value
     */
    private function assertValueIsPossitive(float $value): void
    {
        if ($value < 0) {
            throw new \UnexpectedValueException("Value must be positive");
        }
    }

    /**
     * @param float $value
     */
    private function assertValueIsInAcceptableCurrencyRange(float $value): void
    {
        if (!in_array($value, self::CURRENCY_TYPES)) {
            throw new \UnexpectedValueException(
                sprintf(
                    "Value must match one of the following values: %s",
                    implode(
                        ", ",
                        array_map(fn($currency) => sprintf('%.2f', $currency), self::CURRENCY_TYPES)
                    )
                )
            );
        }
    }

    public function getValue(): float
    {
        return $this->value;
    }

}