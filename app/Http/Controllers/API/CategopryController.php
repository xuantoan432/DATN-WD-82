<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Category;

use Illuminate\Http\Request;

class CategopryController extends Controller
{

    public function show(string $id)
    {
        $cate = Category::findOrFail($id);
        return response()->json($cate);

    }
 public function bienthe(string $id) {
    $giatri = Attribute::select('id', 'name')->findOrFail($id);
    $attributeValues = $giatri->attributeValues()->select('id', 'value')->get();
    $data = [
        'giatri' => $giatri,
        'attribute_values' => $attributeValues,
    ];

     return response()->json($data);
 }

}
