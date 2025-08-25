<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreAttributeValueRequestInterface;
use Illuminate\Validation\Rule;

class StoreAttributeValueRequest extends BaseFormRequest implements StoreAttributeValueRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'value' => ['required', 'string', 'max:255'],
            'attribute_id' => ['required', 'exists:attributes,id'],
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
            'value.required' => 'Giá trị thuộc tính không được để trống.',
            'value.string' => 'Giá trị thuộc tính phải là chuỗi ký tự.',
            'value.max' => 'Giá trị thuộc tính không được vượt quá 255 ký tự.',

            'attribute_id.required' => 'Thuộc tính liên kết không được để trống.',
            'attribute_id.exists' => 'Thuộc tính liên kết không tồn tại.',

            'order.integer' => 'Thứ tự phải là số nguyên.',

            'status.required' => 'Trạng thái không được để trống.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }

    public function imageFile()
    {
        return $this->null;
    }
}
