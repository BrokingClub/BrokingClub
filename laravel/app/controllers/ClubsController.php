<?php

class ClubsController extends \BaseController {

    /**
     * Display a listing of the resource.
     * GET /clubs
     *
     * @return Response
     */
    public function index()
    {
        $clubs = Club::all();

        $this->data['clubs'] = $clubs;

        $this->setTitle('Clubs');

        return $this->makeView('pages.game.club.index');
    }

    /**
     * Show the form for creating a new resource.
     * GET /clubs/create
     *
     * @return Response
     */
    public function create()
    {
        $thePlayer = Player::auth();
        if($thePlayer->club)
            return Redirect::route('clubs.index')->withError('You are already in a club!');

        $clubs = Club::all();

        $this->data['clubs'] = $clubs;

        $this->setTitle('Create a new club');

        return $this->makeView('pages.game.club.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /clubs
     *
     * @return Response
     */
    public function store()
    {
        $thePlayer = Player::auth();
        if(!$thePlayer)
            return Redirect::back()->withError('You are not logged in as a real player.');

        if($thePlayer->club)
            return Redirect::route('clubs.index')->withError('You are already in a club!');

        $club = new Club();

        $club->fill(Input::all());
        $club->owner_id = $thePlayer->id;

        $save = $club->validateAndSave();
        if(!$save)
            return Redirect::back();

        $thePlayer->club_id = $club->id;
        $thePlayer->club_role = 'founder';
        $thePlayer->save();

        return Redirect::route('clubs.show', $club->id)->withMessage('Club created successfully.');
    }

    /**
     * Display the specified resource.
     * GET /clubs/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {

        $club = Club::findOrFail($id);

        if(!$club->isValid()) return $this->failBack('Club ' . $id . ' is not valid.');

        $this->setTitle($club->name . ' - ' . $club->teaser);

        $this->data['club'] = $club;

        return $this->makeView('pages.game.club.show');
    }

    /**
     * Show the form for editing the specified resource.
     * GET /clubs/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $club = Club::findOrFail($id);

        if(!Player::auth()->ownsClub($club))
            return Redirect::route('clubs.show', $id)->withError('You can not edit this club.');

        $this->setTitle("Edit " . $club->name);

        $this->data['club'] = $club;

        return $this->makeView('pages.game.club.edit');
    }

    /**
     * Update the specified resource in storage.
     * PUT /clubs/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $club = Club::findOrFail($id);

        if(!Player::auth()->ownsClub($club))
            return Redirect::route('clubs.show', $id)->withError('You can not edit this club.');



        $club->teaser = Input::get('teaser');
        $club->description = Input::get('description');

        if(!$club->validate(Input::all(), 'teaser,description'))
            return Redirect::route('clubs.edit', $id);

        $club->save();

        return Redirect::route('clubs.show', $club->id);


    }

    /**
     * Remove the specified resource from storage.
     * DELETE /clubs/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}