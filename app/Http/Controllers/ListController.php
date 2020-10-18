<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $options = Option::whereIn('id', $request->session()->get('list.options', array()))->get();
        return view('list/index', ['options' => $options]);
    }

    public function add(Request $request, $optionId)
    {
        $request->session()->push('list.options', $optionId);
        return back();
    }

    public function delete(Request $request, $optionId)
    {
        foreach ($request->session()->get('list.options') as $index => $option) {
            if ($option == $optionId) {
                $request->session()->forget('list.options.'.$index);
            }
        }
        return back();
    }

    public function deleteAll(Request $request)
    {
        $request->session()->flush();
        return back();
    }
}