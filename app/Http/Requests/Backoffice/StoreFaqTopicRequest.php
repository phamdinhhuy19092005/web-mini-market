<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreFaqTopicRequestInterface;
use Illuminate\Validation\Rule;

class StoreFaqTopicRequest extends BaseFormRequest implements StoreFaqTopicRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
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
            'name.required' => 'Tên chủ đề FAQ không được để trống.',
            'name.string' => 'Tên chủ đề FAQ phải là chuỗi ký tự.',
            'name.max' => 'Tên chủ đề FAQ không được vượt quá 255 ký tự.',

            'order.integer' => 'Thứ tự phải là số nguyên.',

            'status.required' => 'Trạng thái không được để trống.',
            'status.in' => 'Trạng thái không hợp lệ.',
        ];
    }
    
    public function imageFile()
    {
        return null;
    }
}
