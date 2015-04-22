<?php

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

		$this->assertTrue($users->count() < 1);
	}

}
