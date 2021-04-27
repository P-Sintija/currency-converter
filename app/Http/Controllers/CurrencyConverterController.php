<?php

namespace App\Http\Controllers;

use App\Services\CurrencyConverterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class CurrencyConverterController extends Controller
{
    private $currencyConverterService;

    public function __construct(CurrencyConverterService $currencyConverterService)
    {
        $this->currencyConverterService = $currencyConverterService;
    }


    public function convert(Request $request): RedirectResponse
    {
        $request['amount'] = str_replace(',', '.', $request['amount']);

        $this->validate($request, [
            'id' => 'required',
            'amount' => ['required', 'numeric', 'gt:10']
        ]);

        $total = $this->currencyConverterService->exchange((int)$request['id'], $request['amount']);

        $symbol = DB::table('currencies')->where('id', (int)$request['id'])->pluck('symbol')[0];
        $rate = DB::table('currencies')->where('id', (int)$request['id'])->pluck('rate')[0];

        return Redirect::route('home.homePage', [
            'total' => $total,
            'amount' => $request['amount'],
            'symbol' => $symbol,
            'rate' => $rate
        ]);
    }

}
