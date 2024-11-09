<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Attribute $attribute)
    {
        $attributeValues = $attribute->attributeValues;
        return view('seller.attributeValues.index', compact('attributeValues', 'attribute'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Attribute $attribute)
    {
        $data = $request->validate([
            'value' => 'required|unique:attribute_values,value' ,
        ]);
        $data['user_id'] = auth()->id();
        $attribute->attributeValues()->create($data);
        return redirect()
            ->route('seller.attribute.values.index', $attribute)
            ->with('success', 'Thêm mới giá trị thuộc tính thành công!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attribute $attribute, AttributeValue $attributeValue)
    {
        $attributeValues = $attribute->attributeValues;
        return view('seller.attributeValues.edit', compact('attributeValue', 'attributeValues', 'attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AttributeValue $attributeValue)
    {
        $data = $request->validate([
            'value' => 'required|unique:attribute_values,value,' . $attributeValue->id,
        ]);
        $attributeValue->update($data);
        return back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute,AttributeValue $attributeValue)
    {
        $attributeValue->delete();
        $attributeValues = $attribute->attributeValues;
        return redirect()->route('seller.attribute.values.index', $attribute)
            ->with('sucess', 'Xóa thành công!');
    }
}
