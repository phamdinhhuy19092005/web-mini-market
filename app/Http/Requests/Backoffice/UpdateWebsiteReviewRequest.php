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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable','email','max:255',Rule::unique('website_reviews', 'email')->ignore($reviewId)],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
            'phone_number' => ['nullable','string','max:20',Rule::unique('website_reviews', 'phone_number')->ignore($reviewId)],
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