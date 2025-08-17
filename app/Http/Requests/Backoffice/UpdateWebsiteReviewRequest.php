<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ReviewStatusEnum;
use App\Http\Requests\Backoffice\Interfaces\UpdateWebReviewRequestInterface;
use Illuminate\Validation\Rule;

class UpdateWebsiteReviewRequest extends BaseFormRequest implements UpdateWebReviewRequestInterface
{
    public function rules(): array
    {
        // Lấy ID của bản ghi từ tham số route
        $reviewId = $this->route('id'); 
        // dd($this->all());
        return [
            'user_id' => ['required', 'exists:users,id'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
            'status' => ['required', Rule::in(ReviewStatusEnum::all())],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('status') && is_string($this->status)) {
            $this->merge([
                'status' => (int) $this->status, 
            ]);
        }
    }

    public function imageFile()
    {
        return null;
    }
}