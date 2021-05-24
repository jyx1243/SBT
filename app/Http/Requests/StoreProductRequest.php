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
            'product.name' => 'required|unique:product|string|max:10',
            'product.subname' => 'nullable|string|max:40',
            'product.category' => 'required|exists:category,id',

            'options.*.name' => 'nullable|distinct|string|max:10',
            // 'options.*.image' => 'nullable|image',
            'options.*.default_price' => 'sometimes|nullable|integer',
            'options.*.default_location' => 'sometimes|nullable|integer',

            'options.*.prices.*.unit' => 'sometimes|required|exists:unit,id',
            'options.*.prices.*.value' => 'sometimes|required|integer|min:0',

            'options.*.locations.*.zone' => 'sometimes|required|exists:zone,id',
            'options.*.locations.*.col' => 'sometimes|nullable|integer|between:0,100',
            'options.*.locations.*.row' => 'sometimes|nullable|integer|between:0,100',
        ];
    }

    public function attributes()
    {
        return [
            'product.name' => '商品名稱',
            'product.subname' => '商品別名',
            'product.category' => '商品類型',

            'options.*.name' => '品項名稱',
            'options.*.image' => '品項圖片',
            'options.*.default_price' => '品項主要價格',
            'options.*.default_location' => '品項主要位置',

            'options.*.prices.*.unit' => '價格單位',
            'options.*.prices.*.value' => '價格金額',

            'options.*.locations.*.zone' => '位置區域',
            'options.*.locations.*.layer' => '位置層',
            'options.*.locations.*.col' => '位置欄',
            'options.*.locations.*.row' => '位置列',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 必須填寫。',
            'unique' => ':attribute":input"已經存在。',
            'distinct' => ':attribute":input"不可跟其他:attribute重複。',
            'between' => ':attribute 必須介於 :min - :max 之間。',
            'max' => ':attribute 最多為 :max 個字。',
            'min' => ':attribute 最少為 :max 個字。',
            'exists' => ':attribute 屬性不在資料庫內。',
            'image' => ':attribute 必須為圖片檔。',
            'integer' => ':attribute 必須為整數。',
            'string' => ':attribute 必須為文字。',
        ];
    }
}
