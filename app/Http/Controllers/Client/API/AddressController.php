<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressDetail;
use Illuminate\Http\Request;
use Kjmtrue\VietnamZone\Models\District;
use Kjmtrue\VietnamZone\Models\Province;
use Kjmtrue\VietnamZone\Models\Ward;

class AddressController extends Controller
{
    public function create(Request $request)
    {
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
        $user = auth()->user();
        $user->update([
            'default_address_id' => $address->id,
        ]);

        AddressDetail::create([
            'address_id' => $address->id,
            'full_name' => $validatedData['full_name'],
            'phone_number' => $validatedData['phone_number'],
        ]);

        $address->load(relations: ['province', 'district', 'ward']);

        return response()->json([
            'success' => true,
            'data' => $address,
            'address_line' => $address->full_address,
        ]);
    }

    public function getAllWards()
    {
        $wards = Ward::all();
        return response()->json([]);
    }

    public function getAllProvinces()
    {
        $provinces = Province::all();

        return response()->json([
            'data' => $provinces
        ]);
    }

    public function getDistrictByProvince($provinceId)
    {
        $province = Province::query()->with('districts')->findOrFail($provinceId);
        return response()->json([
            'data' => $province->districts
        ]);
    }

    public function getWardByDistrict($districtId)
    {
        $district = District::query()->with('wards')->findOrFail($districtId);
        return response()->json([
            'data' => $district->wards
        ]);
    }
}
