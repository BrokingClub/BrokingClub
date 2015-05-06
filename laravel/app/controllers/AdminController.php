<?php

class AdminController extends \BaseController {

    public function __construct(){
        parent::__construct();
        $this->beforeFilter('adminOnly');
    }

    /**
     * Display a listing of the resource.
     * GET /players
     *
     * @return Response
     */
    public function index()
    {
        return $this->makeView('pages.admin.index');
    }

    public function users() {
        $users = User::paginate(15);

        $this->data['users'] = $users;

        return $this->makeView('pages.admin.users');
    }

    public function stocks() {
        return $this->makeView('pages.admin.stocks');
    }

    public function administrateUsers($id) {
        $user = User::findOrFail($id);
        $player = $user->player;
        $data = [];
        $data['user'] = $user;
        $data['player'] = $player;

        return $this->makeView('pages.admin.user')->with($data);
    }

    public function getUser($id){
    }

    /**
     * Show the form for creating a new resource.
     * GET /players/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /players
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /players/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /players/{id}/edit
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
     * PUT /players/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $player = Player::findOrFail($id);
        $user = $player->user;

        $save = $player->validateAndSave();


        if($save)
            return Redirect::route('profile', ['id' => $user->id])->withMessage('Profile has been updated');
        else
            return Redirect::route('profile', ['id' => $user->id]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /players/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}