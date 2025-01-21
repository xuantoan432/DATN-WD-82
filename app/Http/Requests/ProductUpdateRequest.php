<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'namesanpham' => 'required' ,
             'giasanpham' => 'required|numeric|min:0|max:99999999' ,
             'anhsanphamchinh' => 'file' ,
             'motangan' => 'required' ,
             'noidung' => 'required' ,
             'gallery'=> 'array' ,
             'gallery.*' => 'file' ,
             'danhmuc' => 'required' ,
             'masanpham' => 'required|string|max:255' ,

            'variants.*.gia' => 'required|numeric|min:0|max:99999999',
            'variants.*.giamgia' => 'nullable|numeric|min:0|max:99999999',
            'variants.*.sku' => 'required|string|max:255',
            'variants.*.soluong' => 'required|integer|min:1',
            'variants.*.anhbienthe' => 'file',
            'variants.*.ngaybd' => 'nullable|date',
            'variants.*.ngayketthuc' => 'nullable|date|after_or_equal:variants.*.ngaybd',

        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'Trường này là bắt buộc.',
            'valuebute.required' => 'Vui lòng ấn thêm biến thể',
            'gia.*.*.numeric' => 'Giá sản phẩm phải là một số.',
            'min' => 'Vui lòng nhập số lượng tối thiểu là 1 ',
            'max' => 'Vui lòng chỉ nhập 8 chữ  số',
            'file' => 'Ảnh phải là tệp hợp lệ.',
            'mimes' => 'Ảnh phải có định dạng jpg, jpeg, hoặc png.',
            'variants.*.gia.required' => 'Giá sản phẩm là bắt buộc.',
            'variants.*.gia.numeric' => 'Giá sản phẩm phải là một số.',
            'variants.*.gia.min' => 'Giá sản phẩm không được nhỏ hơn 0.',
            'variants.*.gia.max' => 'Giá sản phẩm không được lớn hơn 99.999.999.',
            'variants.*.giamgia.numeric' => 'Giảm giá phải là một số.',
            'variants.*.giamgia.min' => 'Giảm giá không được nhỏ hơn 0.',
            'variants.*.sku.required' => 'Mã sản phẩm là bắt buộc.',
            'variants.*.sku.string' => 'Mã sản phẩm phải là một chuỗi ký tự.',
            'variants.*.sku.max' => 'Mã sản phẩm không được dài quá 255 ký tự.',
            'variants.*.soluong.required' => 'Số lượng là bắt buộc.',
            'variants.*.soluong.integer' => 'Số lượng phải là một số nguyên.',
            'variants.*.soluong.min' => 'Số lượng phải lớn hơn hoặc bằng 1.',
            'variants.*.anhbienthe.required' => 'Ảnh biến thể là bắt buộc.',
            'variants.*.anhbienthe.file' => 'Ảnh biến thể phải là tệp.',
            'variants.*.anhbienthe.mimes' => 'Ảnh biến thể phải là một trong các định dạng: jpg, jpeg, png.',
            'variants.*.anhbienthe.max' => 'Ảnh biến thể không được lớn hơn 2MB.',
            'variants.*.ngaybd.date' => 'Ngày bắt đầu phải là một ngày hợp lệ.',
            'variants.*.ngayketthuc.date' => 'Ngày kết thúc phải là một ngày hợp lệ.',
            'variants.*.ngayketthuc.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu.',
        ];
    }
}
