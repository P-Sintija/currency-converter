<?php

namespace App\Services;

class ExchangeCurrencyRequest
{
    private $total;
    private $amount;
    private $symbol;
    private $rate;

    public function __construct(?int $total, ?string $amount, ?string $symbol, ?int $rate)
    {
        $this->total = $total;
        $this->amount = $amount;
        $this->symbol = $symbol;
        $this->rate = $rate;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function getSymbol(): ?string
    {
        return $this->symbol;
    }
}
