@if ($errors->has($item))
    <div class="help-block validation-error">
        <p>{{ $errors->first($item) }}</p>
    </div>
@endif
