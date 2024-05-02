<div class="my-3 col-md-6">
    <label class="form-label mb-2 w-100">Status <span class="error">*</span></label>
    <div class="form-check form-check-inline">
        <input type="radio" id="status_yes"
            value="{{  App\Helpers\GlobalConstant::STATUS_ACTIVE }}" name="status"
            class="form-check-input" checked=""
            @if(isset($status))
             {{ $status == App\Helpers\GlobalConstant::STATUS_ACTIVE ? 'checked' : '' }}
            @endif
            >
        <label class="mb-0" for="status_yes">Active</label>
    </div>
    <div class="form-check form-check-inline">
        <input type="radio" id="status_no"
            value="{{ App\Helpers\GlobalConstant::STATUS_INACTIVE }}" name="status"
            class="form-check-input"
            @if(isset($status))
                {{ $status == App\Helpers\GlobalConstant::STATUS_INACTIVE ? 'checked' : '' }}
            @endif
            >
        <label class="mb-0" for="status_no">Inactive</label>
    </div>
</div>