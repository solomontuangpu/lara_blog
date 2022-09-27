<div class="mb-3">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" 
            class="form-control @error($name) is-invalid @enderror" 
            name="{{ $multiple ? $name.'[]' : $name }}" id="{{ $name }}"
            value="{{ old($name, $default) }}"
            @if($multiple)
                multiple
            @endif
            >
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror

    @if($multiple)
        @error("$name.*")
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    @endif

</div>