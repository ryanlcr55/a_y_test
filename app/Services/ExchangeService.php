<?php

namespace App\Services;

use phpDocumentor\Reflection\Types\Integer;

class ExchangeService
{
    /**
     * @var array
     */
    protected $currencyMap;

    public function __construct(LoadCurrencyInterface $getCurrencyService)
    {
        $this->currencyMap = $getCurrencyService->load();
    }

    public function exchange(string $source, string $target, float $amount)
    {
        throw_unless(isset($this->currencyMap[$source]),
            new \Exception('Source Currency Not Found.')
        );
        throw_unless(isset($this->currencyMap[$source][$target]),
            new \Exception('Target Currency Not Found.')
        );

        return $amount * $this->currencyMap[$source][$target];
    }
}
