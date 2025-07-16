<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NumberInput extends Component
{
    public string $name;
    public string|float|null $value;
    public string $class;
    public bool $allowMinus;
    public string $key;

    public function __construct(
        string $name,
        string|float|null $value = null,
        string $class = '',
        bool $allowMinus = false,
        string $key = ''
    ) {
        $this->name = $name;
        $this->value = $value;
        $this->class = $class;
        $this->allowMinus = $allowMinus;
        $this->key = $key;
    }

    public function render()
    {
        return view('components.number-input');
    }
}
