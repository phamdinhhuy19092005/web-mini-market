<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ReviewStatusEnum;
use App\Http\Requests\Backoffice\Interfaces\StoreWebsiteReviewRequestInterface;
use Illuminate\Validation\Rule;

class StoreWebsiteReviewRequest extends BaseFormRequest implements StoreWebsiteReviewRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email','max:255', Rule::unique('website_reviews', 'email')],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1000'],
            'phone_number' => ['nullable', 'string', 'max:20', Rule::unique('website_reviews', 'phone_number')],
            'status' => ['required', Rule::in(ReviewStatusEnum::all())],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => filter_var($this->status ?? false, FILTER_VALIDATE_BOOLEAN)
                ? ReviewStatusEnum::APPROVED->value 
                : ReviewStatusEnum::PENDING->value,  
        ]);
    }


    public function imageFile()
    {
        return null;
    }
}
