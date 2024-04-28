@section('title', 'Login or Register')

<div class="mb-3" >
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        class="form-control @error($name) is-invalid @enderror" 
        value="{{ $value ?? '' }}" 
        {{ $required ? 'required' : '' }} 
        autocomplete="{{ $name }}" 
        autofocus
    >
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
