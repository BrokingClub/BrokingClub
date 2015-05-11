<?php

class PlayersController extends \BaseController {

    /**
     * @var \BrokingClub\Statistics\LeaderBoard
     */
    private $leaderBoard;

    public function __construct(){
        parent::__construct();

        $this->leaderBoard = App::make('LeaderBoard');
    }

	/**
	 * Display a listing of the resource.
	 * GET /players
	 *
	 * @return Response
	 */
	public function index()
	{
        $players = Player::orderBy('balance', 'desc')->with('user')->get();

        $this->data['players'] = $players;

        $this->leaderBoard->calculate();

        $this->setTitle('Ranking');

        return $this->makeView('pages.game.player.index');
	}


	/**
	 * Show the form for creating a new resource.
	 * GET /players/create
	 *
	 * @return Response
	 */
	public function create()
	{

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
        $player = Player::findOrFail($id);


        $this->setTitle('User information: '. $player->name());


        $this->data['player'] = $player;
        $this->shareToView('isMyself', $player->id == Player::auth()->id);



        return $this->makeView('pages.game.player.show');
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

    public function joinClub($id)
    {
        $thePlayer = Player::auth();
        if (!$thePlayer)
            return Redirect::back()->withError('You are not logged in as a real player.');

        if ($thePlayer->club_role == 'founder') {
            $oldclub = $thePlayer->club;
            $oldclub->delete();
        }

        $club = Club::findOrFail($id);

        $thePlayer->club_id = $club->id;
        $thePlayer->club_role = 'member';

        $thePlayer->save();

        return Redirect::route('clubs.show', $id)->withMessage('Welcome to ' . $club->name);
    }

    public function leaveClub() {
        $thePlayer = Player::auth();
        if(!$thePlayer)
            return Redirect::back()->withError('You are not logged in as a real player.');

        if ($thePlayer->club_role == 'founder') {
            $club = Club::findOrFail($thePlayer->club->id);
            $club->delete();
        }

        $thePlayer->club_id = 0;
        $thePlayer->club_role = '';

        $thePlayer->save();

        return Redirect::route('clubs.index')->withMessage('You left the club successfully');
    }

    public function kickPlayer($id) {
        $thePlayer = Player::auth();
        if(!$thePlayer)
            return Redirect::back()->withError('You are not logged in as a real player.');

        if($thePlayer->club_role != "founder") {
            return Redirect::back()->withError('You are not the owner of the club!');
        }

        $player = Player::findOrFail($id);

        if($thePlayer->club_id != $player->club_id) {
            return Redirect::back()->withError('You are not in this club');
        }

        $club_id = $thePlayer->club_id;

        $player->club_id = 0;
        $player->club_role = "";
        $player->save();

        return Redirect::route('clubs.edit', ['id' => $club_id])->withMessage('Member got kicked.');
    }

    public function setCareer(){
        $theplayer = Player::auth();

        if($theplayer->career_id != 0)
            return Redirect::to('players/' . Player::auth()->id)->withError('Career is already set.');

        return $this->makeView('pages.lockscreen.setcareer');
    }

    public function doSetCareer(){
        $theplayer = Player::auth();

        if($theplayer->career_id != 0)
            return Redirect::to('players/' . Player::auth()->id)->withError('Career is already set.');

        $career = Career::findOrFail(intval(Input::get('career_id')));
        $theplayer->career_id = $career->id;

        $theplayer->balance = $career->startmoney;
        $theplayer->level = 1;

        $theplayer->save();

        return Redirect::to('players/' . Player::auth()->id)->withMessage('Welcome on board,  ' . $career->name . '.');
    }


    public function dashboard(){
        if(Player::auth()->career_id == 0)
            return Redirect::action('PlayersController@setCareer');
        else
            return Redirect::to('players/' . Player::auth()->id);
    }
}