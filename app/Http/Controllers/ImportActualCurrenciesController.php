<?php

namespace App\Http\Controllers;

use App\Services\ActualCurrenciesService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;


class ImportActualCurrenciesController extends Controller
{
    private $actualCurrenciesService;

    public function __construct(ActualCurrenciesService $actualCurrenciesService)
    {
        $this->actualCurrenciesService = $actualCurrenciesService;
    }

    public function importActualCurrencies(): RedirectResponse
    {
        $this->actualCurrenciesService->import();
        return Redirect::route('home.homePage');
    }
}
