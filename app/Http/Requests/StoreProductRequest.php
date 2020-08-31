<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:product|max:10',
            'subname' => 'max:40',
            'category' => 'required',
            'optionName' => 'max:10',
            'image' => 'image',
            'price' => 'required|integer',
            'unit' => 'required',
            'zone' => 'required',
            // 'col' => 'max:100|integer',
            // 'row' => 'max:100|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名稱是必填的',
            'name.unique' => '商品名稱已重複',
            'name.max' => '商品名稱最多10個字',
            'subname.max' => '商品別名最多40個字',
            'category.required' => '請選擇商品類別',
            'optionName.max' => '子項名稱最多10個字',
            'image.image' => '商品圖片必須為圖片檔',
            'price.required' => '商品價格是必填的',
            'price.integer' => '商品價格必須為整數',
            'unit.required' => '請選擇價格單位',
            'zone.required' => '請選擇位置區域',
            // 'col.integer' => '位置欄必須為整數',
            // 'col.max' => '位置欄最多100',
            // 'row.integer' => '位置列必須為整數',
            // 'row.max' => '位置列最多100',
        ];
    }
}
