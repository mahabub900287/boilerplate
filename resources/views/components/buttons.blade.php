<div class="my-3">
    <div>
        <button class="btn btn-primary waves-effect waves-lightml-2 me-2" type="submit">
            <i class="fa fa-save"></i> {{ $update ?? "Submit" }}
        </button>
        <a class="btn btn-secondary waves-effect" href="{{ $cancleurl ?? '' }}">
            <i class="fa fa-times"></i> Cancel
        </a>
    </div>
</div>