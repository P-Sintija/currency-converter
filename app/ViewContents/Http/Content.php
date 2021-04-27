<?php

namespace App\ViewContents\Http;

use App\Services\ExchangeCurrencyRequest;

class Content
{

    public function execute(array $currencies, ExchangeCurrencyRequest $request): array
    {
        return [
            'currencies' => $currencies,
            'total' => number_format($request->getTotal() / 100000 / 100000, 2),
            'amount' => number_format($request->getAmount(), 2),
            'symbol' => $request->getSymbol(),
            'rate' => number_format($request->getRate() / 100000, 5)
        ];
    }
}
