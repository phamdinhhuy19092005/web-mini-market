<?php

namespace App\Http\Requests;

use App\Enum\ActivationStatus;
use App\Http\Requests\Interfaces\UpdateBannerRequestInterface;
use Illuminate\Validation\Rule;

class UpdateBannerRequest extends BaseFormRequest implements UpdateBannerRequestInterface
{
    public function rules(): array
    {
        // Xóa hoặc comment dòng này
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
            'type' => ['required', 'integer', Rule::in([1, 2, 3])],
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

}
