<div class="row">
    <div class="col-md-6">
        {{ QForm::label('club_name', 'Clubname:') }}
        {{ QForm::text('club_name') }}

        {{ QForm::label('teaser', 'Teaser:') }}
        {{ QForm::textarea('teaser') }}
    </div>

    <div class="col-md-6">
        {{ QForm::label('owner', 'Owner:') }}
        {{ QForm::readOnly('owner', $theplayer->user->username) }}

        {{ QForm::label('description', 'Description') }}
        {{ QForm::textarea('description') }}
    </div>

</div>











