@extends('.........layouts.game')

@section('content')

    {{ Fickle::openPanel('Create a new Club', 12) }}
        {{ QForm::open(['route' => 'clubs.store', 'method' => 'POST']) }}
           @include('partials.forms.club')

            <hr/>
                <div class="clearfix">
                    {{ QForm::btnPrimary('Create new club!', 'plus') }}
                </div>

        {{ QForm::close() }}
    {{ Fickle::closePanel() }}

@endsection