<?php

namespace App\ViewContents\Console;

use App\Services\ExchangeCurrencyRequest;
use Illuminate\Support\Facades\DB;

class Content
{
    public function currencyTable(): string
    {
        $currencies = DB::table('currencies')->get();
        $col = 3;
        $content = [];

        foreach ($currencies as $currency) {
            if ($currency->id <= count($currencies) / 3) {
                if ($currency->id < (count($currencies) / 3) - 1) {
                    $content[($currency->id) - 1] = '[ ' . $currency->id . '] ' . $currency->symbol .
                        str_repeat(' ', (count($currencies) / 3) - 1);
                } else {
                    $content[($currency->id) - 1] = '[' . $currency->id . '] ' . $currency->symbol .
                        str_repeat(' ', (count($currencies) / 3) - 1);
                }
            } else if ($currency->id > count($currencies) / 3 && $currency->id <= 22) {
                $content[($currency->id) - ((count($currencies) / 3) + 1)] =
                    $content[($currency->id) - ((count($currencies) / 3) + 1)] .
                    '[' . $currency->id . '] ' . $currency->symbol .
                    str_repeat(' ', (count($currencies) / 3) - 1);
            } else {
                $content[($currency->id) - ((count($currencies) / 3) * 2 + 1)] =
                    $content[($currency->id) - ((count($currencies) / 3) * 2 + 1)] .
                    '[' . $currency->id . '] ' . $currency->symbol . PHP_EOL;
            }
        }
        return $contentToString = PHP_EOL . implode(' ', $content);
    }

    public function exchangeInfo(int $id, string $amount, int $total): string
    {
        return $this->exchangeText(new ExchangeCurrencyRequest(
            $total,
            $amount,
            DB::table('currencies')->where('id', $id)->pluck('symbol')[0],
            DB::table('currencies')->where('id', $id)->pluck('rate')[0]
        ));
    }

    private function exchangeText(ExchangeCurrencyRequest $request): string
    {
        return number_format($request->getAmount(), 2) . ' Euros = ' .
            number_format($request->getTotal() / 100000 / 100000, 2) . ' ' .
            $request->getSymbol() . PHP_EOL .
            ' 1 EUR = ' .
            number_format($request->getRate() / 100000, 5) . ' ' .
            $request->getSymbol();
    }

}
