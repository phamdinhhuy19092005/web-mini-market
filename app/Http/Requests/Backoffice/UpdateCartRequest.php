<?php

namespace App\Http\Requests\Backoffice;

use App\Enum\ActivationStatus;
use App\Http\Requests\Backoffice\Interfaces\UpdateCartRequestInterface;

class UpdateCartRequest extends BaseFormRequest implements UpdateCartRequestInterface
{
    public function rules(): array
    {
        // dd($this->all());
        return [
           
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
        $this->null;
    }

}
