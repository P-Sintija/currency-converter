<?php

namespace App\Console\Commands;


use App\Services\CurrencyConverterService;
use App\ViewContents\Console\Content;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;


class CurrencyConverterCommand extends Command
{

    protected $signature = 'currency:convert ';
    protected $description = 'Currency converter';

    private $currencyConverterService;
    private $content;

    public function __construct(CurrencyConverterService $currencyConverterService, Content $content)
    {
        parent::__construct();
        $this->currencyConverterService = $currencyConverterService;
        $this->content = $content;
    }

    public function handle()
    {
        echo $this->content->currencyTable();

        $id = $this->ask('choose symbol');
        $amount = $this->ask('enter amount');
        $amount = str_replace(',', '.', $amount);

        $validator = Validator::make([
            'symbol id' => $id,
            'amount' => $amount
        ], [
            'symbol id' => ['required', 'gt:0', 'lt:34', 'numeric'],
            'amount' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            $this->info('Please try again');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return 1;
        }
        $validator->errors()->all();

        $total = $this->currencyConverterService->exchange((int)$id, $amount);

        echo $this->content->exchangeInfo($id, $amount, $total);

        return 0;
    }
}
