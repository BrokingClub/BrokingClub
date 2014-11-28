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

            $this->setTitle('Clubs');

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

        if($thePlayer->club)
            return Redirect::route('clubs.index')->withError('You are already in a club!');

        if(!$thePlayer)
            return Redirect::back()->withError('You are not logged in as a real player.');

        $club = new Club();

        $club->slug = Input::get('club_name');
        $club->teaser = Input::get('teaser');
        $club->description = Input::get('description');
        $club->owner_id = $thePlayer->id;

        $club->save();

        $thePlayer->club_id = $club->id;
        $thePlayer->club_role = 'founder';
        $thePlayer->save();

        return Redirect::route('clubs.show', $club->id);

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
        $this->setTitle('Some club');
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
        //
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
        //
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