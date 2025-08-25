<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreAttributeRequestInterface;
use Illuminate\Validation\Rule;

class StoreAttributeRequest extends BaseFormRequest implements StoreAttributeRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'attribute_type' => ['nullable', 'integer'],
            'order' => ['nullable', 'integer'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'category_ids' => ['required', 'array'],
            'category_ids.*' => ['exists:categories,id'],
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
            'name.required' => 'Tên thuộc tính không được để trống.',
            'name.string' => 'Tên thuộc tính phải là chuỗi ký tự.',
            'name.max' => 'Tên thuộc tính không được vượt quá 255 ký tự.',

            'attribute_type.integer' => 'Loại thuộc tính phải là số nguyên.',

            'order.integer' => 'Thứ tự phải là số nguyên.',

            'status.required' => 'Trạng thái không được để trống.',
            'status.in' => 'Trạng thái không hợp lệ.',

            'category_ids.required' => 'Danh mục liên kết không được để trống.',
            'category_ids.array' => 'Danh mục liên kết phải là một mảng.',
            'category_ids.*.exists' => 'Danh mục liên kết không tồn tại.',
        ];
    }

    public function imageFile()
    {
        return $this->null;
    }
}
