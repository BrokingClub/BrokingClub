<?php
/**
 * Project: BrokingClub | AdminBaseController.php
 * Author: Simon - www.triggerdesign.de
 * Date: 06.05.2015
 * Time: 13:48
 */
class AdminBaseController extends BaseController
{
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
} 