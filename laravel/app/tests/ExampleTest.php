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
		$crawler = $this->client->request('GET', '/login');

        $users = User::all();

        $fakeUser = LFaker::build('User');

        dd($fakeUser);

        $this->assertEquals(5, $users->count());
	}

}
