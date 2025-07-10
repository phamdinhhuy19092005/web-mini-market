<?php

namespace App\Http\Requests\Backoffice\Interfaces;

interface BaseRequestInterface
{
    public function rules(): array;

    public function validated();

    public function imageFile();
}
