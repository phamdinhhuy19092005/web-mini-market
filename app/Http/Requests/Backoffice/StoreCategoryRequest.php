<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreCategoryRequestInterface;
use Illuminate\Validation\Rule;

class StoreCategoryRequest extends BaseFormRequest implements StoreCategoryRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],

            'category_group_id' => ['required', 'exists:category_groups,id'],

            'image' => ['nullable', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['nullable', 'string', 'max:255'],

            'description' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:255'],
            'seo_description' => ['nullable', 'string', 'max:255'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'status' => boolval($this->status) ? ActivationStatus::ACTIVE : ActivationStatus::INACTIVE,
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên danh mục không được để trống.',
            'name.string' => 'Tên danh mục phải là chuỗi ký tự.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'name.regex' => 'Tên danh mục chỉ được chứa chữ cái và khoảng trắng.',

            'slug.required' => 'Slug không được để trống.',
            'slug.string' => 'Slug phải là chuỗi ký tự.',
            'slug.max' => 'Slug không được vượt quá 255 ký tự.',
            'slug.unique' => 'Slug đã tồn tại, vui lòng chọn tên khác.',

            'category_group_id.required' => 'Nhóm danh mục không được để trống.',
            'category_group_id.exists' => 'Nhóm danh mục không tồn tại.',

            'image.file' => 'Ảnh phải là file hợp lệ.',
            'image.mimes' => 'Ảnh phải có định dạng: jpeg, png, gif, webp.',
            'image.max' => 'Ảnh không được lớn hơn 5MB.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',
            'seo_title.string' => 'Tiêu đề SEO phải là chuỗi ký tự.',
            'seo_title.max' => 'Tiêu đề SEO không được vượt quá 255 ký tự.',
            'seo_description.string' => 'Mô tả SEO phải là chuỗi ký tự.',
            'seo_description.max' => 'Mô tả SEO không được vượt quá 255 ký tự.',

            'status.required' => 'Trạng thái danh mục không được để trống.',
            'status.in' => 'Trạng thái danh mục không hợp lệ.',
        ];
    }

    public function imageFile()
    {
        return $this->file('image');
    }
}

