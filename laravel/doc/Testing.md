{{{ TOC }}}

{{{ DOCSTART }}}

{{{ STARTCONTENT }}}

# Testing

## Functional tests

## Unit testing

### Test Plan (RUP)
!!TODO 

### Test coverage

### Automatic deploy

### Test Log

## Stress test

### Seeding the database
For the stress test we had to flood our test database with a lot of users.

This is when a faker module such as:
[Fzaninotto/Faker](https://github.com/fzaninotto/Faker)
comes in handy.

#### PlayersTableSeeder.php
```
...
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

    $player = new Player([
        'user_id' => "1",
        'balance' => "1337",
        'level' => "1",
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName
    ]);

    $player->save();
...
```

Simply run:
```
$ php artisan db:seed --class=PlayersTableSeeder
```
in your command line and you will end up with a bunch of unique users/players in the database.


{{{ ENDCONTENT }}}

{{{ DOCEND }}}
