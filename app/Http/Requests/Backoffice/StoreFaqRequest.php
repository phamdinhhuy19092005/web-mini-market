<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\StoreFaqRequestInterface;
use Illuminate\Validation\Rule;

class StoreFaqRequest extends BaseFormRequest implements StoreFaqRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string'],
            'order' => ['nullable', 'integer'],
            'status' => ['required', Rule::in(ActivationStatus::all())],
            'faq_topic_id' => ['required', 'integer', 'exists:faq_topics,id'],
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

    
    public function imageFile()
    {
        return null;
    }

    public function messages(): array
    {
        return [
            'question.required'      => 'Vui lòng nhập câu hỏi.',
            'question.string'        => 'Câu hỏi phải là chuỗi văn bản.',
            'question.max'           => 'Câu hỏi không được vượt quá :max ký tự.',
            'answer.required'        => 'Vui lòng nhập câu trả lời.',
            'answer.string'          => 'Câu trả lời phải là chuỗi văn bản.',
            'order.integer'          => 'Thứ tự hiển thị phải là số nguyên.',
            'status.required'        => 'Vui lòng chọn trạng thái hiển thị.',
            'status.in'              => 'Trạng thái không hợp lệ.',
            'faq_topic_id.required'  => 'Vui lòng chọn chủ đề.',
            'faq_topic_id.integer'   => 'Chủ đề không hợp lệ.',
            'faq_topic_id.exists'    => 'Chủ đề đã chọn không tồn tại.',
        ];
    }
}
