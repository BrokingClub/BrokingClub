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
        return $this->makeView('pages.login');
    }
} 