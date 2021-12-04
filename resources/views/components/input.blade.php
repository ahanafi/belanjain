<div class="form-group row">
    <label for="{{ $fieldName }}" class="col-sm-3 col-form-label">{{ $label }}</label>
    <div class="col-sm-9">
        <input
            type="{{ $type }}"
            @if($isRequired) required="required" @endif
            name="{{ $fieldName }}"
            value="{{ $value !== '' ? $value : old($fieldName) }}"
            class="form-control @error($fieldName) is-invalid @enderror"
            placeholder="{{ $placeholder }}"
            autocomplete="off"
        >

        @error($fieldName)
            <span class="invalid-feedback d-block" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
