<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $optionIds = array_column($request->session()->get('list.options', array()), 'optionId');
        $options = collect();
        foreach ($optionIds as $optionId) {
            $option = Option::find($optionId);
            $options->push($option);
        }
        return view('list/index', ['options' => $options]);
    }

    public function add(Request $request, $optionId)
    {
        $option = ['optionId' => $optionId, 'quantity' => $request->input('quantity', 1), 'unit' => $request->input('unit')];
        $index = array_search($optionId, array_column($request->session()->get('list.options', array()), 'optionId'));
        if ($index !== false) {
            $request->session()->put('list.options.'.$index, $option);
        } else {
            $request->session()->push('list.options', $option);
        }
        return response()->json($request->session()->get('list.options', array()));
    }

    public function update(Request $request, $optionId)
    {
        $option = ['optionId' => $optionId, 'quantity' => $request->quantity, 'unit' => $request->unit];
        $index = array_search($optionId, array_column($request->session()->get('list.options', array()), 'optionId'));
        $request->session()->put('list.options.'.$index, $option);
        return response()->json($request->session()->get('list.options', array()));
    }

    public function delete(Request $request, $optionId)
    {
        $options = $request->session()->pull('list.options', array());
        $index = array_search($optionId, array_column($options, 'optionId'));
        unset($options[$index]);
        $request->session()->put('list.options', array_values($options));
        return response()->json($request->session()->get('list.options', array()));
    }

    public function deleteAll(Request $request)
    {
        $request->session()->forget('list.options');
        return back();
    }
}