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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return $this->makeView('pages.admin.users.edit');
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