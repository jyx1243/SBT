<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Price;

class PriceController extends Controller
{
    public function store(Request $request, $optionId)
    {
        $price = new Price;
        $price->option_id = $optionId;
        $price->value = $request->input('price');
        $price->unit_id = $request->input('unit');
        $price->save();

        if ($request->has('defaultPrice')) {
            $option = Option::find($optionId);
            $option->default_price_id = $price->id;
            $option->save();
        }

        return back()->with('status', '價格新增成功');
    }

    public function destroy($optionId, $priceId)
    {
        $price = Price::find($priceId);
        $option = Option::find($optionId);
        if ($option->default_price_id == $price->id) {
            $option->default_price_id = null;
            $option->save();
        }
        $price->delete();

        return back()->with('status', '價格刪除成功');
    }
}
