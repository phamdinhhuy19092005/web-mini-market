<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreCategoryGroupRequestInterface;
use Illuminate\Validation\Rule;

class StoreCategoryGroupRequest extends BaseFormRequest implements StoreCategoryGroupRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:category_groups,slug'],

            'image' => ['required', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['nullable', 'string'],

            'cover' => ['required', 'array'],
            'cover.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'cover.path' => ['nullable', 'string'],

            'banner' => ['required', 'array'],
            'banner.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'banner.path' => ['nullable', 'string'],

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

    public function imageFile()
    {
        return $this->file('image', 'cover', 'banner');
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

            'image.required' => 'Ảnh danh mục không được để trống.',
            'image.file' => 'Ảnh danh mục phải là file hợp lệ.',
            'image.mimes' => 'Ảnh danh mục phải có định dạng: jpeg, png, gif, webp.',
            'image.max' => 'Ảnh danh mục không được lớn hơn 5MB.',

            'cover.required' => 'Ảnh cover không được để trống.',
            'cover.file' => 'Ảnh cover phải là file hợp lệ.',
            'cover.mimes' => 'Ảnh cover phải có định dạng: jpeg, png, gif, webp.',
            'cover.max' => 'Ảnh cover không được lớn hơn 5MB.',

            'banner.required' => 'Ảnh banner không được để trống.',
            'banner.file' => 'Ảnh banner phải là file hợp lệ.',
            'banner.mimes' => 'Ảnh banner phải có định dạng: jpeg, png, gif, webp.',
            'banner.max' => 'Ảnh banner không được lớn hơn 5MB.',

            'description.string' => 'Mô tả phải là chuỗi ký tự.',

            'seo_title.string' => 'Tiêu đề SEO phải là chuỗi ký tự.',
            'seo_title.max' => 'Tiêu đề SEO không được vượt quá 255 ký tự.',

            'seo_description.string' => 'Mô tả SEO phải là chuỗi ký tự.',
            'seo_description.max' => 'Mô tả SEO không được vượt quá 255 ký tự.',

            'status.required' => 'Trạng thái danh mục không được để trống.',
            'status.in' => 'Trạng thái danh mục không hợp lệ.',
        ];
    }

}
