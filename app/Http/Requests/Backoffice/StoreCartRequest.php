<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreCartRequestInterface;
use Illuminate\Validation\Rule;

class StoreCartRequest extends BaseFormRequest implements StoreCartRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [

            'name' => ['required', 'string', 'max:255'],

            'image' => ['nullable', 'array'],
            'image.file' => ['nullable', 'file', 'mimes:jpeg,png,gif,webp', 'max:5200'],
            'image.path' => ['required', 'string', 'max:255'],

            'order' => ['nullable', 'integer'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status, FILTER_VALIDATE_BOOLEAN)
                ? ActivationStatus::ACTIVE
                : ActivationStatus::INACTIVE,
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng nhập tên thương hiệu.',
            'image.file.mimes' => 'Ảnh phải có định dạng jpeg, png, gif, hoặc webp.',
            'image.path.required' => 'Vui lòng chọn hình ảnh.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
    
    public function imageFile()
    {
        return $this->file('image');
    }
}
