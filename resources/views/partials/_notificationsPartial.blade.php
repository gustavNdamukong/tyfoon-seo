@if (isset($errors))
    @if ((is_array($errors) && count($errors) > 0) || $errors->any())
        <div class="alert alert-danger alert-error position-relative">
            @if (is_array($errors))
            <p>
                @foreach ($errors as $error)
                    {{ $error }}<br />
                @endforeach
            </p>
            @else
            <p>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br />
                @endforeach
            </p>
            @endif
        </div>
    @endif
@endif


@if(session('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
@endif

@if(session('danger'))
    <div class="alert alert-danger">
        <p>{{ session('danger') }}</p>
    </div>
@endif



@if(session('warning'))
    <div class="alert alert-warning">
        <p>{{ session('warning') }}</p>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        <p>{{ session('info') }}</p>
    </div>
@endif