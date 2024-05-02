<div class="form-group mt-3">
    <label class="form-label" for="{{ $name }}">{{ $label }} @if ($required??false) <span class="error">*</span> @endif</label>
    <textarea name="{{ $name }}" type="text" class="form-control {{ $class ?? '' }}" rows="{{ $rows ?? 5 }}"  {{ $required ?? '' }}
        rows="5">{{ $value ?? '' }}</textarea>
    @if (!empty($errorName))
        @error($errorName)
            <span class="text-danger fs-6">{{ $message }}</span>
        @enderror
    @endif
</div>