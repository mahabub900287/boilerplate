<div class="form-group mt-3">
    <label for="{{ $name }}" class="mb-2">{{ $label ?? 'Input label' }}</label>
    <input name="{{ $name }}" id="{{ $name }}" class="form-control py-2{{ $class ?? '' }}" placeholder="{{ $placeholder ?? '' }}" type="{{ $type ?? 'file' }}" value="{{ $value ?? old($name) }}">
    
    @if (!empty($errorName))
        @error($errorName)
            <span class="text-danger fs-6">{{ $message }}</span>
        @enderror
    @endif
</div>
