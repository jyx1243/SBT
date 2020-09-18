<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sale;

class SaleController extends Controller
{
    public function store(Request $request, $optionId, $priceId)
    {
        $sale = new Sale;
        $sale->price_id = $priceId;
        $sale->value = $request->input('sale');
        $sale->quantity = $request->input('quantity');
        $sale->save();

        return back()->with('status', '優惠新增成功');
    }

    public function destroy($optionId, $priceId, $saleId)
    {
        $sale = Sale::find($saleId);
        $sale->delete();

        return back()->with('status', '優惠刪除成功');
    }
}
