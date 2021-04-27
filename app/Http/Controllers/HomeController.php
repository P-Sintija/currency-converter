<?php

namespace App\Http\Controllers;


use App\Services\ExchangeCurrencyRequest;
use App\ViewContents\Http\Content;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    private $content;

    public function __construct(Content $content)
    {
        $this->content = $content;
    }

    public function homePage(Request $request): View
    {
        $currencies = [];
        $data = DB::table('currencies')->get();
        foreach ($data as $currency) {
            $currencies[] = [
                'id' => $currency->id,
                'symbol' => $currency->symbol,
                'rate' => $currency->rate
            ];
        }

        $currency = new ExchangeCurrencyRequest(
            $request['total'],
            $request['amount'],
            $request['symbol'],
            $request['rate']
        );

        return view('home', $this->content->execute($currencies, $currency));
    }
}
