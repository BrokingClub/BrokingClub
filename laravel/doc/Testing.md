{{{ TOC }}}

{{{ DOCSTART }}}

{{{ STARTCONTENT }}}

# Testing

## Functional tests
`Wie haben wir function tests gemacht, links zu Seite`

## Unit testing
`Wie haben wir unit tests gemacht`

### Test Plan (RUP)
`Von Marc auszufüllen`
*(RUP Test Plan.md)[http://broking.club/doc/?f=rup-testing)*

### Test coverage
`welche tools, wie benachrichtigung, aktueller stand und link`

### Automatic deploy
`travis beschreiben, wie das triggern läuft und benachrichtigungen`

### Test Log
`build success abzeichen`

## Stress test
`kurz beschreiben was wir gemacht haben, warum man stress tests macht`

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

### Running the stress test
`wie er durchgeführt wurde

### Results of the stresst test
`was kam dabei raus, diagramm?`

{{{ ENDCONTENT }}}

{{{ DOCEND }}}
