<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'province_id',
        'district_id',
        'ward_id',
        'address_line',  // Thêm trường này vào để cho phép mass assignment
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_address');
    }

    public function sellers()
    {
        return $this->belongsToMany(Seller::class, 'seller_address');
    }

    public function userWithThisAsDefault()
    {
        return $this->hasOne(User::class, 'default_address_id');
    }
    public function details()
    {
        return $this->hasOne(AddressDetail::class);
    }
    public function getFullAddress()
    {
        try {
            // Lấy thông tin từ API
            $province = $this->getLocationFromApi('p', $this->province_id);
            $district = $this->getLocationFromApi('d', $this->district_id);
            $ward = $this->getLocationFromApi('w', $this->ward_id);

            // Trả về địa chỉ đầy đủ
            return "{$this->address_line}, {$ward['name']}, {$district['name']}, {$province['name']}";
        } catch (\Exception $e) {
            // Xử lý lỗi
            return "Không thể lấy địa chỉ đầy đủ.";
        }
    }

    private function getLocationFromApi($type, $id)
    {
        $response = Http::get("https://provinces.open-api.vn/api/{$type}/{$id}?depth=2");

        if ($response->ok()) {
            return $response->json(); // Trả về dữ liệu JSON từ API
        }

        throw new \Exception("Không thể tải dữ liệu {$type}");
    }
}
