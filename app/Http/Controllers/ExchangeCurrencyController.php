<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeCurrencyRequest;
use App\Services\ExchangeService;

class ExchangeCurrencyController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/exchange",
     *      tags={"Projects"},
     *      summary="轉換匯率",
     *      description="轉換匯率至小數點後兩位",
     *      @OA\Parameter(
     *         name="source_currency",
     *         in="query",
     *         description="使用幣別",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="traget_currency",
     *         in="query",
     *         description="兌換幣別",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Parameter(
     *         name="amount",
     *         in="query",
     *         description="兌換金額",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  type="object",
     *                  required={""},
     *                  example={
     *                      "result": "1,000.00"
     *                  },
     *                  @OA\Property(property="result",type="string",example="1,000.00",description="兌換結果"),
     *            )
     *         )
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *          @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  type="object",
     *                  required={""},
     *                  example={
     *                       "message": "Target Currency Not Found."
     *                  },
     *                  @OA\Property(property="message",type="string",example="Target Currency Not Found.",description="找不到要兌換的幣別"),
     *            )
     *         )
     *       ),
     *     )
     */
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
            ], 400);
        }
    }
}
