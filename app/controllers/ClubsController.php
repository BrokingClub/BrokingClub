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
        //
    }

    /**
     * Show the form for creating a new resource.
     * GET /clubs/create
     *
     * @return Response
     */
    public function create()
    {
        //hello
    }

    /**
     * Store a newly created resource in storage.
     * POST /clubs
     *
     * @return Response
     */
    public function store()
    {
        //hello
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