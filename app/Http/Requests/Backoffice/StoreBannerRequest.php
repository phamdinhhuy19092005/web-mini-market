<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\BannerTypeEnum;
use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreBannerRequestInterface;
use Illuminate\Validation\Rule;

class StoreBannerRequest extends BaseFormRequest implements StoreBannerRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],

            'desktop_image' => ['required', 'array'],
            'desktop_image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'desktop_image.path' => ['nullable', 'string'],

            'mobile_image' => ['required', 'array'],
            'mobile_image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'mobile_image.path' => ['nullable', 'string'],

            'label' => ['nullable', 'string', 'max:255'],
            'type' => ['required', 'integer', Rule::in(BannerTypeEnum::all())],

            'cta_label' => ['nullable', 'string', 'max:255'],
            'redirect_url' => ['nullable', 'url'],
            'order' => ['nullable', 'integer', 'min:0'],
            'color' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'start_at' => ['required', 'date'],
            'end_at' => ['nullable', 'date', 'after_or_equal:start_at'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }



    public function prepareForValidation()
    {
        $this->merge([
            'status' => boolval($this->status) ? ActivationStatus::ACTIVE : ActivationStatus::INACTIVE,
        ]);
    }

    public function imageFile()
    {
        return [
            'desktop' => $this->file('desktop_image.file'),
            'mobile' => $this->file('mobile_image.file'),
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên banner không được để trống.',
            'name.string' => 'Tên banner phải là chuỗi ký tự.',
            'name.max' => 'Tên banner không được vượt quá 255 ký tự.',

            'desktop_image.required' => 'Ảnh desktop không được để trống.',
            'desktop_image.file' => 'Ảnh desktop phải là file hợp lệ.',
            'desktop_image.mimes' => 'Ảnh desktop phải có định dạng: jpeg, png, gif, webp.',
            'desktop_image.max' => 'Ảnh desktop không được lớn hơn 5MB.',

            'mobile_image.required' => 'Ảnh mobile không được để trống.',
            'mobile_image.file' => 'Ảnh mobile phải là file hợp lệ.',
            'mobile_image.mimes' => 'Ảnh mobile phải có định dạng: jpeg, png, gif, webp.',
            'mobile_image.max' => 'Ảnh mobile không được lớn hơn 5MB.',

            'label.string' => 'Nhãn phải là chuỗi ký tự.',
            'label.max' => 'Nhãn không được vượt quá 255 ký tự.',

            'type.required' => 'Loại banner không được để trống.',
            'type.integer' => 'Loại banner phải là số nguyên.',
            'type.in' => 'Loại banner không hợp lệ.',

            'cta_label.string' => 'Nhãn nút phải là chuỗi ký tự.',
            'cta_label.max' => 'Nhãn nút không được vượt quá 255 ký tự.',

            'redirect_url.url' => 'URL chuyển hướng không hợp lệ.',

            'order.integer' => 'Thứ tự phải là số nguyên.',
            'order.min' => 'Thứ tự không được nhỏ hơn 0.',

            'color.string' => 'Màu sắc phải là chuỗi ký tự.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',

            'seo_title.string' => 'Tiêu đề SEO phải là chuỗi ký tự.',
            'seo_title.max' => 'Tiêu đề SEO không được vượt quá 255 ký tự.',

            'seo_description.string' => 'Mô tả SEO phải là chuỗi ký tự.',
            'seo_description.max' => 'Mô tả SEO không được vượt quá 255 ký tự.',

            'start_at.required' => 'Ngày bắt đầu không được để trống.',
            'start_at.date' => 'Ngày bắt đầu không hợp lệ.',

            'end_at.date' => 'Ngày kết thúc không hợp lệ.',
            'end_at.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',

            'status.required' => 'Trạng thái banner không được để trống.',
            'status.in' => 'Trạng thái banner không hợp lệ.',
        ];
    }
        

}
