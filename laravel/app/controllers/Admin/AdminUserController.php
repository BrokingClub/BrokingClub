<?php
use BrokingClub\Repositories\PlayerRepository;

/**
 * Project: BrokingClub | AdminUserController.php
 * Author: Simon - www.triggerdesign.de
 * Date: 06.05.2015
 * Time: 13:50
 */
class AdminUserController extends AdminBaseController
{

    /**
     * @var PlayerRepository
     */
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository){
        parent::__construct();

        $this->playerRepository = $playerRepository;
    }

    public function index(){

        $users = User::paginate(15);
        $data['users'] = $users;
        return $this->makeView('pages.admin.users')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return "show user";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $player = $user->player;

        $this->shareToView('user', $user);
        $this->shareToView('player', $player);
        $this->shareToView('careers', Career::lists('name', 'id'));
        $this->shareToView('clubs', Club::lists('name', 'id'));

        return $this->makeView("pages.admin.users.edit");
    }

    public function update($id) {
        $player = Player::findOrFail($id);

        $inputPlayer = Input::only('firstname', 'lastname', 'balance', 'exp', 'club_id', 'club_role', 'career_id');
        $inputUser = Input::only('email', 'username', 'role');

        $playerResult = $player->validateAndSave($inputPlayer);

        $user = $player->user;
        $userResult = $user->validateAndSave($inputUser);

        if(!$playerResult || !$userResult){
            return Redirect::back()->withError("Fail");
        }

        return Redirect::back()->withMessage('Success!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
} 