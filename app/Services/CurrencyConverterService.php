<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class CurrencyConverterService
{
    public function exchange(int $id, string $amount): int
    {
        $rate = DB::table('currencies')->where('id', $id)->pluck('rate');
        return $rate[0] * (int)($amount * 100000);
    }
}

