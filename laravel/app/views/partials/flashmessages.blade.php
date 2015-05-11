@if (Session::get('error'))
    <div class="alert alert-error alert-danger">
        @if (is_array(Session::get('error')))
            {{ head(Session::get('error')) }}
        @else
            {{ Session::get('error') }}
        @endif
    </div>
@endif
@if (Session::has('validationErrors'))
     <div class="alert alert-error alert-danger">
        <ul>
            @foreach(Session::get('validationErrors')->all() as $error)
                <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
@endif

@if (Session::get('notice'))
    <div class="alert alert-info">{{ Session::get('notice') }}</div>
@endif
@if (Session::get('message'))
    <div class="alert alert-success">{{ Session::get('message') }}</div>
@endif

@if (Session::get('rolePlay.expAdded'))
    <div class="alert alert-info">
        <b>{{ Session::get('rolePlay.expAdded.title') }}:</b>
        {{ Session::get('rolePlay.expAdded.message') }}
    </div>
@endif

@if (Session::get('rolePlay.levelUp'))
    <div class="alert alert-success">
        <b>{{ Session::get('rolePlay.levelUp.title') }}:</b>
        {{ Session::get('rolePlay.levelUp.message') }}
    </div>
@endif

