<?php

namespace App\ValueObjects;

use App\ValueObjects\Exceptions\InvalidValueObject;
use App\ValueObjects\Exceptions\MisbehavedValueObject;

class Money
{
    const DEFAULT = '$';
    const CONVERSION = [
        '$' => 1,
    ];

    public string $currency;

    public int $amountInCent;

    public static function withDefaultCurrency(int $amountInCent)
    {
        return new static(static::DEFAULT, $amountInCent);
    }

    /**
     * Money constructor.
     * @param  string  $currency
     * @param  int  $amountInCent
     */
    public function __construct(string $currency, int $amountInCent)
    {
        if ($amountInCent < 0) {
            InvalidValueObject::throwIt(
                sprintf('Invalid Money amount: %s', $amountInCent)
            );
        }

        $this->currency = strtoupper($currency);
        $this->amountInCent = $amountInCent;
    }

    public function add(Money $money): self
    {
        return new static($money->currency, $money->amountInCent + $this->amountInCent);
    }

    public function minus(Money $money): self
    {
        $amount = $this->amountInCent - $money->amountInCent;

        if ($amount < 0) {
            MisbehavedValueObject::throwIt('Invalid negative Money amount');
        }

        return new static($this->currency, $amount);
    }

    public function multiply(int $number): self
    {
        return new static($this->currency, abs($number) * $this->amountInCent);
    }

    public function divide($number): self
    {
        return new static($this->currency, intval($this->amountInCent / abs($number)));
    }

    public function percent(Percentage $percentage): self
    {
        $amountInCent = $this->amountInCent * $percentage->percent / 100;

        return new self($this->currency, round($amountInCent));
    }

    public function percentDiscardDecimal(Percentage $percentage): self
    {
        $amountInCent = $this->amountInCent * $percentage->percent / 100;

        return new self($this->currency, (int) $amountInCent);
    }

    public function isGreater(Money $money): bool
    {
        return $this->amountInCent > $money->amountInCent;
    }

    public function equals(Money $money): bool
    {
        return $this->currency === $money->currency &&
            $this->amountInCent === $money->amountInCent;
    }

    public function oneQuarter(): self
    {
        return new static($this->currency, intval($this->amountInCent / 4));
    }

    public function half(): self
    {
        return new static($this->currency, intval($this->amountInCent / 2));
    }

    public function isZero(): bool
    {
        return $this->amountInCent === 0;
    }

    public function toString(): string
    {
        return sprintf('%s%s', $this->currency, number_format($this->amountInCent / 100, 2));
    }

    public function toDecimal(): float
    {
        return floatval($this->amountInCent / 100);
    }

    public function convert(string $currency): Money
    {
        if (self::DEFAULT === $this->currency && isset(self::CONVERSION[$currency])) {
            return new static($currency, self::CONVERSION[$currency] * $this->amountInCent);
        }
        return $this;
    }
}
