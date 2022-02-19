<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeCurrencyRequest;
use App\Services\ExchangeService;

class ExchangeCurrencyController extends Controller
{
    public function exchange(ExchangeCurrencyRequest $request, ExchangeService $exchangeService)
    {
        try {
            $attribute = $request->all();
            $result = $exchangeService->exchange(
                $attribute['source_currency'],
                $attribute['target_currency'],
                $attribute['amount']
            );

            return response()->json(
                ['result' =>  number_format($result, 2)]
            );
        } catch (\Exception $exception) {
            return response()->json([
                'message' =>  $exception->getMessage(),
            ], 404);
        }
    }
}
