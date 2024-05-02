<div class="form-group {{ $mainclass ?? '' }}">
    <label for="{{ $name }}" class="form-label">{{ $label ?? 'Input label' }} @if ($required ?? false)
            <span class="error text-danger">*</span>
        @endif
        @if ($optional ?? false)
            <span class="">(optional)</span>
        @endif
    </label>
    <input name="{{ $name }}" id="{{ $name }}" class="form-control{{ $class ?? '' }}"
        placeholder="{{ $placeholder ?? '' }}" type="{{ $type ?? 'text' }}" value="{{ $value ?? old($name) }}"
        {{ $required ?? '' }}>
    @if (!empty($errorName))
        @error($errorName)
            <span class="err-txt">{{ $message }}</span>
        @enderror
    @endif
</div>
