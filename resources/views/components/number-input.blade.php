<div>
    <input 
        type="text" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        class="{{ $class }}" 
        @if (!$allowMinus) min="0" @endif
        data-key="{{ $key }}">
</div>