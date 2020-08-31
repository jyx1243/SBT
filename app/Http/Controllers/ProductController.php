<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Option;
use App\Models\Category;
use App\Models\Price;
use App\Models\Unit;
use App\Models\Location;
use App\Models\Zone;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Option::orderBy('id')->get();
        return view('product/index', ['options' => $options]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::orderBy('id')->get();
        $units = Unit::orderBy('id')->get();
        $zones = Zone::orderBy('id')->get();
        return view('product/create', ['categorys' => $categorys, 'units' => $units, 'zones' => $zones]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // 如果路徑不存在，就自動建立
        if (!file_exists('img/product')) {
            mkdir('img/product', 0755, true);
        }

        $product = new Product;
        $product->name = $request->input('name');
        $product->subname = $request->input('subname');
        $product->category_id = $request->input('category');
        $product->save();

        $option = new Option;
        $option->product_id = $product->id;
        $option->name = $request->input('optionName');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = public_path() . '/img/product';
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
        } else {
            $fileName = 'default.png';
        }
        $option->image = $fileName;
        $option->save();

        $price = new Price;
        $price->option_id = $option->id;
        $price->unit_id = $request->input('unit');
        $price->value = $request->input('price');
        $price->save();

        $location = new Location;
        $location->option_id = $option->id;
        $location->zone_id = $request->input('zone');
        $location->layer = $request->input('layer');
        $location->col = $request->input('col');
        $location->row = $request->input('row');
        $location->save();

        if ($request->has('defaultPrice')) {
            $option->default_price_id = $price->id;
            $option->save();
        }

        if ($request->has('defaultLocation')) {
            $option->default_location_id = $location->id;
            $option->save();
        }

        return redirect()->route('product.show', $option->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = Option::find($id);
        return view('product/show', ['option' => $option]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
