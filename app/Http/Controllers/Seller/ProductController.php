<?php

namespace App\Http\Controllers\Seller;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Attribute;

class ProductController extends Controller
{
     const PATH_URL = 'seller.products.' ;
    public function index()
    {
        //
    }


    public function create()
    {
        $categories  = Category::all();
        $bienthe = Attribute::all();
         return view(self::PATH_URL . __FUNCTION__ , compact('categories' , 'bienthe'));
    }


    public function store(Request $request)
    {
        //
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
