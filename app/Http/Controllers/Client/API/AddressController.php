<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressDetail;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function create(Request $request){
        $validatedData = $request->validate([
            'address_line' => 'required|string|max:255',
            'province' => 'required|integer',
            'district' => 'required|integer',
            'ward' => 'required|integer',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required',
        ]);

        $address = Address::create([
            'address_line' => $validatedData['address_line'],
            'province_id' => $validatedData['province'],
            'district_id' => $validatedData['district'],
            'ward_id' => $validatedData['ward'],
        ]);

        $address->users()->attach($request->user()->id);

        AddressDetail::create([
            'address_id' => $address->id,
            'full_name' => $validatedData['full_name'],
            'phone_number' => $validatedData['phone_number'],
        ]);
        return response()->json([
            'success' => true,
            'data' => $address
        ]);
    }

}
