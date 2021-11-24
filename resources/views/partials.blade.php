<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
        value="{{ isset($value) ? $value : '' }}" class="form-control @error('{{ $name }}') is-invalid @enderror">
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
