<div class="row">
    <div class="col-md-8">
        {{ QForm::label('name', 'Clubname:') }}
        {{ QForm::text('name') }}
    </div>

    <div class="col-md-4">
        {{ QForm::label('slug', 'Short Name:') }}
        {{ QForm::text('slug') }}
    </div>

    <div class="col-md-12">
        {{ QForm::label('teaser', 'Teaser:') }}
        {{ QForm::textarea('teaser', null, ['size' => '50x2']) }}
    </div>

    <div class="col-md-12">
        {{ QForm::label('description', 'Description') }}
        {{ QForm::textarea('description') }}
    </div>

</div>











