<div class="container">
    <div class="row">
        <div class="{{ $class }}" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            @if($preText)
                <p><i class="{{ $icon }}"></i> {!! $preText !!}</p>
            @endif
            <ul>
                @foreach( $errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>