
<div class="form-group mt-3">
    <label for="{{ $name }}" class="{{ $required ?? '' }} form-label">{{ $label }}</label><br>
    <select name="{{ $name }}" id="{{ $name }}" class="d-block form-control py-2 shadow-none form-select{{ $class ?? '' }}">
    {{ $slot }}
    </select>
    @if (!empty($errorName))
        @error($errorName)
            <span class="text-danger fs-6">{{ $message }}</span>
        @enderror
    @endif
</div>
