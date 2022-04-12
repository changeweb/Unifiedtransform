@if (session('status'))
    <p class="text-success">
        <i class="bi bi-exclamation-diamond-fill me-2"></i> {{ session('status') }}
    </p>
@endif
@if (session('error'))
    <p class="text-danger">
        <i class="bi bi-exclamation-diamond-fill me-2"></i> {{ session('error') }}
    </p>
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <p class="text-danger">
            <i class="bi bi-exclamation-diamond-fill me-2"></i>
            {{ $error }}
        </p>
    @endforeach
@endif