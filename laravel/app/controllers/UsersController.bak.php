<?php
/**
 * Project: BrokingClub | UsersController.php
 * Author: Simon - www.triggerdesign.de
 * Date: 17.10.2014
 * Time: 17:35
 */

class UsersController extends BaseController{
    public function showLogin(){
        $this->setTitle('Login');
        return $this->makeView('pages.game.login');
    }

    public function create(){
        $this->setTitle('Register');
        return $this->makeView('pages.game.register');
        // bla
    }

    /**
     * Show the form for editing the specified resource.
     * GET /stocks/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->setTitle('Edit profile');
        return $this->makeView('pages.game.user.edit');
    }
} 