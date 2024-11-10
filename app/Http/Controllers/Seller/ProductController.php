<?php

namespace App\Http\Controllers\Seller;

use App\Models\User;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductVariantAttribute;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProducStoreRequest;

class ProductController extends Controller
{
    const PATH_URL = 'seller.products.';
    const PATH_UPLOAD = 'products';
    public function index()
    {

    }


    public function create()
    {
        $id_user  =   Auth::id();
        $categories  = Category::get();
        $bienthe = Attribute::where('user_id', $id_user)->get();

        $attributeValues = [];
        foreach ($bienthe as $value) {
            $attributeValues[$value->id] = AttributeValue::where([
                ['attribute_id', '=', $value->id],
                ['user_id', '=', $id_user]
            ])
                ->pluck('value', 'id')
                ->toArray();
        }
        // dd($attributeValues);
        return view(self::PATH_URL . __FUNCTION__, compact('categories', 'bienthe', 'attributeValues'));
    }


    public function store(ProducStoreRequest  $request)
    { 
        $seller = User::findOrFail(Auth::id())->seller;
        $seller_id = $seller ? $seller->id : null;

        $dataProduct = [
            'category_id' => $request->danhmuc,
            'seller_id' => $seller_id,
            'name' => $request->namesanpham,
            'short_description' => $request->motangan,
            'sku' => $request->masanpham,
            'content' => $request->noidung,
            'price' => $request->giasanpham,
        ];
        if (!empty($request->anhsanphamchinh)) {
            $dataProduct['image'] = Storage::put(self::PATH_UPLOAD, $request->anhsanphamchinh);
        }
        // thêm sản phẩm chính vào product
        $product = Product::create($dataProduct);


            if ($request->hasFile('gallery')) {
                foreach ($request->file('gallery') as $image) {
                    $path = Storage::put('galleries', $image);
                    Gallery::create([
                        'product_id' => $product->id,
                        'image' => $path,
                    ]);
                }
            }

            foreach ($request->variants as $variant) {
                $datavariant = [
                    'product_id' => $product->id,
                    'sku' => $variant['sku'],
                    'price' => $variant['gia'],
                    'price_sale' => $variant['giamgia'],
                    'stock_quantity' => $variant['soluong'],
                    'date_start' => $variant['ngaybd'],
                    'date_end' => $variant['ngayketthuc'],
                ];
                if (isset($variant['anhbienthe']) && $variant['anhbienthe']) {
                    $datavariant['image'] = Storage::put('products/variants', $variant['anhbienthe']);
                }
                $variantproduct =  ProductVariant::create($datavariant);
                foreach ($variant['idvalue'] as $value) {
                    $attributeValue = AttributeValue::findOrFail($value);
                    $data = [
                        'product_variant_id'=> $variantproduct->id,
                        'attribute_id' => $attributeValue->attribute_id,
                        'attribute_value_id' => $attributeValue->id,
                    ];
                    ProductVariantAttribute::create($data);
                }
                $datavariant = [];
            }
        return response()->json([
            'success' => 'Thêm Thành công',
            'color' => 'success',
            'icon' => 'bi bi-check2-circle',
        ]);
    }


    public function show(string $id)
    {
        //
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
