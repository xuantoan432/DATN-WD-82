<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detailProduct(Product $product)
    {
        $product->load([
            'variants.attributes.attribute',
            'category',
            'reviews',
            'galleries',
            'seller'
        ]);
        $productrelated = Product::where('is_verified', operator: true)
                                ->where('status', 'active')
                                ->where('id', '<>', $product->id)
                                ->withAvg('reviews', 'star')
                                ->limit(4)
                                ->get();
        $attributes = [];
        $imageVariants = [];
        $priceSales = [];
        $priceRegulars = [];

        foreach ($product->variants as $variant) {
            $imageVariants[] = $variant->image;
            $priceRegulars[] = $variant->price;
            if (!empty($variant->price_sale)) {
                $priceSales[] = $variant->price_sale;
            }
            foreach ($variant->attributes as $attributeValue) {
                $attributeName = $attributeValue->attribute->name;
                $valueName = $attributeValue->value;

                if (!isset($attributes[$attributeName])) {
                    $attributes[$attributeName] = [
                        'id' => $attributeValue->attribute->id,
                        'name' => $attributeName,
                        'values' => []
                    ];
                }

                if (!in_array($valueName, $attributes[$attributeName]['values'])) {
                    $attributes[$attributeName]['values'][ $attributeValue->id] = $valueName;
                }
            }
        }
        $attributes = array_values($attributes);
        $averageRating = $product->reviews->where('parent_id', 0)->avg('star');
        $reviews = $product->reviews->groupBy('parent_id');
        return view('client.product-info', compact('product', 'reviews','averageRating','attributes', 'imageVariants', 'priceSales', 'priceRegulars', 'imageVariants', 'priceSales', 'productrelated'));
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(10);
        return view('client.search-product', compact('products','keyword'));
    }
}
