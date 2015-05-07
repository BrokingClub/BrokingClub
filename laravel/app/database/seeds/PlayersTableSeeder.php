<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PlayersTableSeeder extends Seeder {

	public function run()
	{
        Eloquent::unguard();

		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
            $repo = App::make('UserRepository');

            $username = 'fake-' . $faker->firstName;
            $email = $faker->email;
            $password = Hash::make($faker->userName . $faker->year);

            $user = $repo->signup([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'password_confirmation' => $password
            ]);

            if(!$user->id){
                dd($user->errors()->all(':message'));
            }

			$player = new Player([
                'user_id' => "1",
                'balance' => "1337",
                'level' => "1",
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName
            ]);

            $player->save();

           echo 'create player for user ' . $user->id . "\r\n";
		}
	}

}