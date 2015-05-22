<?php
/**
 * Project: BrokingClub | PlayerTest.php
 * Author: Simon - www.triggerdesign.de
 * Date: 10.05.2015
 * Time: 17:16
 */

use Laracasts\TestDummy\Factory as LFaker;

class UserTest extends TestCase{

    public function testIsAdmin(){
        $user = $this->userMock();

        $this->assertFalse($user->isAdmin());

        $user->role = "admin";
        $this->assertTrue($user->isAdmin());
    }

    public function testCanEdit(){
        $user = $this->userMock();

        $canEdit = User::canEdit($user->id, $user->id);
        $canNotEdit = User::canEdit($user->id, 2);

        $this->assertTrue($canEdit);
        $this->assertFalse($canNotEdit);
    }


    /**
     * @return \User
     */
    public function userMock(){
        $purchase = LFaker::build('User');
        return $purchase;
    }

} 