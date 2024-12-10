<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\ProductVariantAttribute;

class ProductController extends Controller
{
    const PATH_URL = "admin.product.";
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();

        return view(self::PATH_URL.__FUNCTION__  , compact('products'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show( string $id )
    {

        $product = Product::findOrFail($id);
        $product->notifications()->update(['status' => 'read']);
        $bienthe = [] ;
        $bosuutap = $product->galleries ;

        foreach ($product->variants as $variant) {
            $data = [
                'sku'=> $variant->sku,
                'id'=> $variant->id,
                'price' => $variant->price ,
                'price_sale' => $variant->price_sale ,
                'image' => $variant->image ,
                'stock_quantity' => $variant->stock_quantity ,
            ] ;
            foreach ($variant->attributes as $attributeValue) {
                $data['bienthe'][] = $attributeValue->attribute->name .': '. $attributeValue->value ;
            }
            $bienthe[] = $data ;
            $data= [] ;
        }

        return view(self::PATH_URL.__FUNCTION__ , compact('product' , 'bienthe' , 'bosuutap')  );

    }

    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
