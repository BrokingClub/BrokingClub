<?php

use Laracasts\TestDummy\Factory as LFaker;

class ExampleTest extends TestCase {


    /**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		//$crawler = $this->client->request('GET', '/login');

        // LFaker::$factoriesPath = 'app/tests/factories';

        $users = User::all();

        $player = Player::find(1);

        $player->balance = 999;

        $player->save();

        // $fakeClub = LFaker::build('Club');

        // $this->assertTrue($fakeClub->validate(), 'Validate random club');
        $this->assertEquals($users->count(), $users->count(), 'Users count');
	}

}
