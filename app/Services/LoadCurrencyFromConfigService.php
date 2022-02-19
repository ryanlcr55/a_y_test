<?php

namespace App\Services;

class LoadCurrencyFromConfigService implements LoadCurrencyInterface
{
    public function load(): array
    {
        return json_decode(config('currency'), true)['currencies'];
    }
}
