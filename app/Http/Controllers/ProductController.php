<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Option;
use App\Models\Price;
use App\Models\Location;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $queries = array();
        // parse_str($_SERVER['QUERY_STRING'], $queries);
        // unset($queries['page']);

        $options = Option::when($request->search, function ($query) use ($request) {
            $keyword = '%'.$request->search.'%';
            return $query->where('name', 'like', $keyword)
            ->orWhereHas('product', function ($query) use ($keyword) {
                $query->where('name', 'like', $keyword)
                ->orWhere('subname', 'like', $keyword);
            })
            ->orWhereHas('ingredient', function ($query) use ($keyword) {
                $query->where('description', 'like', $keyword)
                ->orWhereHas('options', function ($query) use ($keyword) {
                    $query->where('name', 'like', $keyword)
                    ->orWhereHas('product', function ($query) use ($keyword) {
                        $query->where('name', 'like', $keyword)
                        ->orWhere('subname', 'like', $keyword);
                    });
                });
            });
        })
        ->when($request->category, function ($query) use ($request) {
            $categorys = $request->category;
            return $query->whereHas('product', function ($query) use ($categorys) {
                $query->whereIn('category_id', $categorys);
            });
        })
        ->when($request->order, function ($query) use ($request) {
            switch ($request->order) {
                case 'id':
                    return $query->orderBy('id', 'asc');
                case 'used':
                    return $query->orderBy('used_at', 'desc');
                case 'created':
                    return $query->orderBy('created_at', 'desc');
                case 'category':
                    return $query->whereHas('product', function ($query) {
                        $query->orderBy('category_id', 'asc');
                    });
            }
        }, function ($query) {
            return $query->orderBy('id', 'asc');
        })
        ->with([
            'prices' => function ($query) {
                $query->orderBy('unit_id');
            },
            'prices.sales'
        ])
        ->paginate(5)
        ->withPath('product')
        ->appends($request->query());

        // ['search' => $request->search, 'category' => $request->category, 'order' => $request->order]
        // $options = Option::join('product', 'option.product_id', '=', 'product.id')
        //     ->when($request->search, function ($query) use ($queries) {
        //         $keyword = '%' . $queries['search'] . '%';
        //         return $query->leftJoin('ingredient', 'option.id', '=', 'ingredient.option_id')
        //             ->leftJoin('ingredient_option', 'ingredient.id', '=', 'ingredient_option.ingredient_id')
        //             ->leftJoin('option as iOption', 'ingredient_option.option_id', '=', 'iOption.id')
        //             ->leftJoin('product as iProduct', 'iOption.product_id', '=', 'iProduct.id')
        //             ->where(function ($query) use ($keyword) {
        //                 $query->where('product.name', 'like', $keyword)
        //                     ->orWhere('product.subname', 'like', $keyword)
        //                     ->orWhere('option.name', 'like', $keyword)
        //                     ->orWhere('ingredient.description', 'like', $keyword)
        //                     ->orWhere('iproduct.name', 'like', $keyword)
        //                     ->orWhere('iproduct.subname', 'like', $keyword)
        //                     ->orWhere('ioption.name', 'like', $keyword);
        //             });
        //     })
        //     ->when($request->category, function ($query) use ($queries) {
        //         return $query->whereIn('product.category_id', $queries['category']);
        //     })
        //     ->when($request->order, function ($query) use ($queries) {
        //         switch ($queries['order']) {
        //             case '最近觀看':
        //                 return $query->orderBy('option.used_at', 'desc');
        //             case '最近新增':
        //                 return $query->orderBy('option.created_at', 'desc');
        //             case '商品類型':
        //                 return $query->orderBy('product.category_id', 'asc');
        //         }
        //     }, function ($query) {
        //         return $query->orderBy('option.id', 'asc');
        //     })
        //     ->select('option.*', 'product.id as product_id', 'product.name as product_name', 'product.subname', 'product.category_id')
        //     ->groupBy('option.id')
        //     ->with('prices')
        //     ->paginate(5)
        //     ->withPath('product')
        //     ->appends($queries);

        $categoryCounts = Category::when($request->search,function ($query) use ($request) {
            $keyword = '%'.$request->search.'%';
            return $query->withCount([
                'options' => function ($query) use ($keyword) {
                    $query->where('option.name', 'like', $keyword)
                    ->orWhereHas('product', function ($query) use ($keyword) {
                        $query->where('name', 'like', $keyword)
                        ->orWhere('subname', 'like', $keyword);
                    })
                    ->orWhereHas('ingredient', function ($query) use ($keyword) {
                        $query->where('description', 'like', $keyword)
                        ->orWhereHas('options', function ($query) use ($keyword) {
                            $query->where('name', 'like', $keyword)
                            ->orWhereHas('product', function ($query) use ($keyword) {
                                $query->where('name', 'like', $keyword)
                                ->orWhere('subname', 'like', $keyword);
                            });
                        });
                    });
                }
            ]);
        }, function ($query) {
            return $query->withCount('options');
        })->get();

        // $categoryCounts = array();
        // if ($request->search) {
        //     $keyword = '%'.$request->search.'%';
        //     // $searchs = Option::join('product', 'option.product_id', '=', 'product.id')
        //     //     ->leftJoin('ingredient', 'option.id', '=', 'ingredient.option_id')
        //     //     ->leftJoin('ingredient_option', 'ingredient.id', '=', 'ingredient_option.ingredient_id')
        //     //     ->leftJoin('option as iOption', 'ingredient_option.option_id', '=', 'iOption.id')
        //     //     ->leftJoin('product as iProduct', 'iOption.product_id', '=', 'iProduct.id')
        //     //     ->where('product.name', 'like', $keyword)
        //     //     ->orWhere('product.subname', 'like', $keyword)
        //     //     ->orWhere('option.name', 'like', $keyword)
        //     //     ->orWhere('ingredient.description', 'like', $keyword)
        //     //     ->orWhere('iproduct.name', 'like', $keyword)
        //     //     ->orWhere('iproduct.subname', 'like', $keyword)
        //     //     ->orWhere('ioption.name', 'like', $keyword)
        //     //     ->select('option.*', 'product.category_id')
        //     //     ->groupBy('option.id')
        //     //     ->get();
        //     // foreach (Category::all() as $category) {
        //     //     $categoryCount[$category->id] = $searchs->where('category_id', $category->id)->count();
        //     // }
        //     $categoryCounts = Category::withCount(['options' => function (Builder $query) use ($keyword) {
        //         $query->where('option.name', 'like', $keyword)
        //         ->orWhereHas('product', function (Builder $query) use ($keyword) {
        //             $query->where('name', 'like', $keyword)
        //             ->orWhere('subname', 'like', $keyword);
        //         })
        //         ->orWhereHas('ingredient', function (Builder $query) use ($keyword) {
        //             $query->where('description', 'like', $keyword)
        //             ->orWhereHas('options', function (Builder $query) use ($keyword) {
        //                 $query->where('name', 'like', $keyword)
        //                 ->orWhereHas('product', function (Builder $query) use ($keyword) {
        //                     $query->where('name', 'like', $keyword)
        //                     ->orWhere('subname', 'like', $keyword);
        //                 });
        //             });
        //         });
        //     }])->get();
        // } else {
        //     // foreach (Category::all() as $category) {
        //     //     $categoryCount[$category->id] = $category->options->count();
        //     // }
        //     $categoryCounts = Category::withCount('options')->get();
        // }

        // return view('product/index', ['options' => $options, 'queries' => $queries, 'categoryCount' => $categoryCount]);
        return response()->json(['options' => $options, 'categoryCounts' => $categoryCounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product/create');
    }

    public function createOption($productId)
    {
        $product = Product::find($productId);
        return view('product/createOption', ['product' => $product]);
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

        // 新增商品
        $product = new Product;
        $product->name = $request->input('name');
        $product->subname = $request->input('subname');
        $product->category_id = $request->input('category');
        $product->save();

        return $this->storeOption($request, $product->id);
    }

    public function storeOption(Request $request, $productId)
    {
        $product = Product::find($productId);

        // 新增分項
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

        // 新增價格
        $price = new Price;
        $price->option_id = $option->id;
        $price->unit_id = $request->input('unit');
        $price->value = $request->input('price');
        $price->save();

        if ($request->has('defaultPrice')) {
            $option->default_price_id = $price->id;
            $option->save();
        }

        // 新增位置
        $location = new Location;
        $location->option_id = $option->id;
        $location->zone_id = $request->input('zone');
        $location->layer = $request->input('layer');
        $location->col = $request->input('col');
        $location->row = $request->input('row');
        $location->save();

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
    public function show($optionId)
    {
        $option = Option::find($optionId);
        $option->used_at = date("Y-m-d H:i:s");
        $option->save();
        return view('product/show', ['option' => $option]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($optionId)
    {
        $option = Option::find($optionId);
        return view('product/edit', ['option' => $option]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $optionId)
    {
        $option = Option::find($optionId);
        // 表單驗證
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:product,name,' . $option->product->id . '|max:10',
        ], [
            'name.unique' => '商品名稱已重複',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // 表單已經驗證，儲存到資料庫
        $option->name = $request->input('optionName');
        if ($request->hasFile('image')) {
            if ($option->image != 'default.jpg') {
                @unlink('img/product/' . $option->image);
            }
            $file = $request->file('image');
            $path = public_path() . '/img/product';
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);
            $option->image = $fileName;
        }
        $option->save();

        // 儲存商品
        $product = $option->product;
        $product->name = $request->input('name');
        $product->subname = $request->input('subname');
        $product->category_id = $request->input('category');
        $product->save();

        // 儲存價格
        foreach ($option->prices->sortBy('unit_id')->values() as $priceIndex => $price) {
            $price->value = $request->input('price.' . $priceIndex);
            $price->save();
            // 儲存優惠
            foreach ($price->sales as $saleIndex => $sale) {
                $sale->value = $request->input('sale.' . $priceIndex . '.' . $saleIndex);
                $sale->quantity = $request->input('quantity.' . $priceIndex . '.' . $saleIndex);
                $sale->save();
            }
        }

        // 儲存默認價格
        if ($request->has('defaultPrice')) {
            $option->default_price_id = $request->input('defaultPrice');
            $option->save();
        }

        // 儲存位置
        foreach ($option->locations as $index => $location) {
            $location->zone_id = $request->input('zone.' . $index);
            $location->layer = $request->input('layer.' . $index);
            $location->col = $request->input('col.' . $index);
            $location->row = $request->input('row.' . $index);
            $location->save();
        }

        // 儲存默認位置
        if ($request->has('defaultLocation')) {
            $option->default_location_id = $request->input('defaultLocation');
            $option->save();
        }

        return redirect()->route('product.show', $option->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($optionId)
    {
        $option = Option::find($optionId);
        $option->defaultPrice()->dissociate();
        $option->defaultLocation()->dissociate();
        $option->save();

        if (count($option->product->options) == 1) {
            $option->product->delete();
        } else {
            $option->delete();
        }

        return redirect()->route('product.index');
    }
}
