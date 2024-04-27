@foreach (['danger', 'warning', 'success', 'info'] as $type)
    @if($message = Session::has($type) ? Session::get($type) : @$flash[$type])
        <div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
            {{--            <div class="fw-semibold"></div> --}}
            <div class="alert-body">
                {!! $message !!}
            </div>
            {{-- <button class="btn-close" type="button" data-dismiss="alert" aria-label="Close"></button> --}}
        </div>
    @endif
@endforeach

@if($errors->any())
    <div class="alert alert-danger fade show" role="alert">
        {{--            <div class="fw-semibold"></div> --}}
        <div class="alert-body">
            {{ $errors->first() }}
        </div>
    </div>
@endif

