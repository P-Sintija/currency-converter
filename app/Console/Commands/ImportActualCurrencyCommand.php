<?php

namespace App\Console\Commands;


use App\Services\ActualCurrenciesService;

use Illuminate\Console\Command;

class ImportActualCurrencyCommand extends Command
{

    protected $signature = 'currency:import';
    protected $description = 'Actual currencies';


    private $actualCurrenciesService;

    public function __construct(ActualCurrenciesService $actualCurrenciesService)
    {
        parent::__construct();
        $this->actualCurrenciesService = $actualCurrenciesService;
    }


    public function handle()
    {
        $this->actualCurrenciesService->import();

        return 0;
    }
}
