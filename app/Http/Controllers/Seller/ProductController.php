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
use App\Events\EventNotification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductVariantAttribute;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProducStoreRequest;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    const PATH_URL = 'seller.products.';
    const PATH_UPLOAD = 'products';
    public function index()
    {
        $id_user  =   Auth::user();
        $id = $id_user->seller->id;
        $products = Product::where([['seller_id', $id], ['is_verified', 1]])->orderBy('id', 'desc')->get();

        return view(self::PATH_URL . __FUNCTION__, compact('products'));
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

        $thongbao =  $product->notifications()->create([
            'title' => 'Đăng sản phẩm ',
            'message' => 'Cần admin phê duyệt !! ',
            'receiver_type' => 'admin',
        ]);
        broadcast(new EventNotification($thongbao, $seller));
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
                // $attributeValue = AttributeValue::findOrFail($value);
                $attributeValue = AttributeValue::where([
                    ['user_id', '=', Auth::id()],
                    ['value', '=', $value]
                ])->firstOrFail();

                $data = [
                    'product_variant_id' => $variantproduct->id,
                    'attribute_id' => $attributeValue->attribute_id,
                    'attribute_value_id' => $attributeValue->id,
                ];
                ProductVariantAttribute::create($data);
            }
            $datavariant = [];
        }

        return response()->json([
            'success' => 'Đăng sản phẩm thành công , vui lòng đợi Admin phê duyệt sản phẩm của bạn',
            'color' => 'success',
            'icon' => 'bi bi-check2-circle',
        ]);
    }


    public function show(Product $product)
    {
        ///
    }


    public function edit(Product $product)
    {
        $data = $product;
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
        $productVariants = [];
        $bosuutap = $product->galleries;
        $quanlityAtribute = 0;
        foreach ($product->variants as $variant) {
            $data1 = [
                'sku' => $variant->sku,
                'id' => $variant->id,
                'price' => $variant->price,
                'price_sale' => $variant->price_sale,
                'image' => $variant->image,
                'stock_quantity' => $variant->stock_quantity,
                'date_start'  =>  date('Y-m-d\TH:i', strtotime($variant->date_start)),
                'date_end'  => date('Y-m-d\TH:i', strtotime($variant->date_end))
            ];

            $i = 0;

            foreach ($variant->attributes as $attributeValue) {
                $i++;

                $data1['bienthe'][] = [
                    "idAttribute" => $attributeValue->attribute->id,
                    "nameAttribute" => $attributeValue->attribute->name,

                    "nameAttributeValue" => $attributeValue->value,
                    "idAttributeValue" => $attributeValue->id
                ];
            }
            $quanlityAtribute = $i;
            $productVariants[] = $data1;
            $data1 = [];
        }
        //  dd($productVariants);
        return view(self::PATH_URL . __FUNCTION__, compact(
            'data',
            'categories',
            'bienthe',
            'attributeValues',
            'productVariants',
            'bosuutap',
            'quanlityAtribute'
        ));
    }


    public function update(ProductUpdateRequest $request, Product $product)
    {
        //  dd($request->all());
        $status = $request->trangthai  ? 'active' : 'inactive';
        $dataProduct = [
            'category_id' => $request->danhmuc,
            'name' => $request->namesanpham,
            'short_description' => $request->motangan,
            'sku' => $request->masanpham,
            'content' => $request->noidung,
            'price' => $request->giasanpham,
            'status' => $status,
        ];
        if ($request->hasFile('anhsanphamchinh')) {
            $dataProduct['image'] = Storage::put(self::PATH_UPLOAD, $request->anhsanphamchinh);
            Storage::delete($product->image);
        }
        $product->update($dataProduct);
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $path = Storage::put('galleries', $image);
                Gallery::create([
                    'product_id' => $product->id,
                    'image' => $path,
                ]);
            }
        }
        // $existingVariant = [] ;
        foreach ($request->variants as $variant) {
            $existingVariant = ProductVariant::find($variant['id']);

            if ($existingVariant) {

                $dataToUpdate = [
                    'sku' => $variant['sku'],
                    'price' => $variant['gia'],
                    'price_sale' => $variant['giamgia'],
                    'stock_quantity' => $variant['soluong'],
                    'date_start' => $variant['ngaybd'],
                    'date_end' => $variant['ngayketthuc'],
                ];


                if (isset($variant['anhbienthe']) && $variant['anhbienthe']) {
                    // Lưu ảnh mới
                    $path = Storage::put('products/variants', $variant['anhbienthe']);
                    if ($path) {
                        $dataToUpdate['image'] = $path;
                        if ($existingVariant->image) {
                            Storage::delete($existingVariant->image);
                        }
                    }
                }

                $existingVariant->update($dataToUpdate);
            }
        }
        //  dd($existingVariant);
        return redirect()->back()->with('success', 'Cập nhật thành công!');

    }


    public function destroy(Product $product)
    {
        $product->delete();
        foreach ($product->variants as $variant) {
            $variant->delete();
            foreach ($variant->attributes as $value) {
                $value->delete();
            }
        }
        return response()->json([
            'pro' =>  "Thành Công",

        ], 200);
    }
}
