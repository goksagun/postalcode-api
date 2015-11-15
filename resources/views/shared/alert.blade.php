@if($alerts = session('alert'))
    <div class="alert-container">
        @foreach($alerts as $type => $message)
            <div class="alert alert-{{ $type }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <strong>{{ ucfirst($type) }}!</strong> {{ $message }}
            </div>
        @endforeach
    </div>
@endif