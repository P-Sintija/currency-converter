<?php

namespace App\Services;

use App\Models\Currency;

class ActualCurrenciesService
{

    public function import(): void
    {
        $currentCurrenciesXML = file_get_contents('https://www.bank.lv/vk/ecb.xml');
        $xmlElements = simplexml_load_string($currentCurrenciesXML);
        $currentCurrenciesJSON = json_encode($xmlElements);
        $currencies = json_decode($currentCurrenciesJSON, true);

        foreach ($currencies['Currencies']['Currency'] as $currency) {
            Currency::updateOrCreate(
                ['symbol' => $currency['ID']],
                ['symbol' => $currency['ID'],
                    'rate' => (int)((float)$currency['Rate'] * 100000)
                ]);
        }
    }
}
