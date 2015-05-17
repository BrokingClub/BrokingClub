{{{ TOC }}}

{{{ DOCSTART }}}

{{{ STARTCONTENT }}}

# Testing

## Functional tests
[Cucumber](https://cucumber.io/) was our choice to describe functional tests.  
It provides a high level of abstraction for writing tests, business people can describe requirements for the tests in plain text and developers write the corresponding test implementation in their favorite programming language.  
As always the npm repository (node package manager) does not disappoint, of course an [official JavaScript Cucumber implementation](https://www.npmjs.com/package/cucumber) is available.  
In order to make the functional tests as transparent as possible for interested people we build a page to view the feature text, step definition and result.  
The tests will be executed in real-time as soon as you select a feature: [Functional tests](http://node.broking.club/#/cucumber)

## Unit testing
The excellent PHP framework Laravel has been build from ground up to [support unit testing](http://laravel.com/docs/master/testing).    
Each and every fresh installation of Laravel includes [PHPUnit](https://phpunit.de/).  
In addition the unit testing configuration file is also set up and pre-configured.
Unit tests can be executed via SSH:  
![PHPUnit](http://broking.club/img/doc/testing/phpunit.JPG)  
  
In addition to that unit tests will be executed automatically by our build service [Travis](https://travis-ci.org/BrokingClub/BrokingClub):  
![PHPUnit](http://broking.club/img/doc/testing/phpunit_travis.jpg)  
  
We finish up this section by including a unit test from our project written in PHP:  
![Unit test](http://broking.club/img/doc/testing/unittest.jpg)

### Test Plan (RUP)
`Von Marc auszufüllen`
**[RUP Test Plan.md](http://broking.club/doc/?f=rup-testing)**

### Test coverage
In software programming test coverage (also known as code coverage) describes a metric used to determine if source code is completely covered by its test suite.  
We decided to use the service [CodeClimate](https://codeclimate.com/github/BrokingClub/BrokingClub) which is free for open-source projects on GitHub.  
Every build which Travis runs generates test data which is then sent to CodeClimate. The service monitors the state of test coverage and calculates changes which will be displayed in the feed:  
![CodeClimate feed](http://broking.club/img/doc/testing/codeclimate_feed.jpg)  
  
The feed page can be easily forgotten and metrics could get worse without anyone noticing, therefor notifications will be pushed to our team collaboration software [HipChat](https://www.hipchat.com/):  
![HipChat](http://broking.club/img/doc/hipchat.jpg)  
  
Our current status is availabe on our [GitHub repository](https://github.com/BrokingClub/BrokingClub) page and via the badges provided by CodeClimate:  
[![Test Coverage](https://codeclimate.com/github/BrokingClub/BrokingClub/badges/coverage.svg)](https://codeclimate.com/github/BrokingClub/BrokingClub/coverage)  
If you are interested in more details feel free to visit our [CodeClimate feed](https://codeclimate.com/github/BrokingClub/BrokingClub).

### Automatic deploy
Continuous delivery is accomplished by using two services.  
New pushes to the GitHub repository trigger a fresh build on [Travis CI](https://travis-ci.org/BrokingClub/BrokingClub).  
Travis will clone the master branch and install all dependencies on a clean container-based infrastructure.  
Developers favorite excuse
> It works on my machine!  
  
will no longer be acceptable.  
This is great for our build process but we have not deployed our new changes to the live system yet.  
The final step will be handled by [dploy](http://dploy.io/), this service uses SFTP for our environment to upload changes to the production server.  
Here you can get a glimpse of what dploy looks like:  
![dploy](http://broking.club/img/doc/testing/dploy.jpg)

### Test Log
Back in the dark days long test logs where used to check if everything is working as expected.  
Today with modern tools in place we can simply rely on fancy badges on our GitHub repository:  
[![Build Status](https://travis-ci.org/BrokingClub/BrokingClub.svg)](https://travis-ci.org/BrokingClub/BrokingClub)  
Hopefully the badge is green while you are reading this.

## Stress test
Stress testing (in other words torture testing or load testing) is used to determine the capabilities of a system.  
The environment will be deliberately put under intense testing which exceeds the average load.  
Failure of the system can be allowed while stress testing in order to learn the capacity and hit break points.  
A stable system should also automatically revert back to normal operation as soon as the load testing has ended.  
  
Our project is a web application, the most efficient and realistic way to put our website under a lot of pressure is to
increase the volume in our database by seeding it with fake entries and subsequently generating massive amounts of requests 
in a short period of time on our application.

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
For the execution of our stress test we needed a local tool and a remote service.  
A local program on our server can test the system as long as it does not exceed CPU usage.  
At this point it would generate false data because the machine will be busy executing only the load testing.  
    
In true npm manner and complying with rule 43 the repository offers the [loadtest](https://www.npmjs.com/package/loadtest) package.  
It can be installed with one command and generates requests depending on the command line arguments specified.  
  
Remote testing was accomplished with the cloud-based service [Loader](https://loader.io/).  
You will have to verify that the target host belongs to you by publishing a Loader verification token and then you are 
good to go.  
The service offers many configuration options and publishes useful result diagrams.

### Results of the stresst test
Results using npm loadtest:  
![npm loadtest](http://broking.club/img/doc/testing/loadtest.jpg)
  
Diagrams generated by Loader.io and [Cloudflare](https://www.cloudflare.com/) (content delivery network and DDOS protection):  
![loader0](http://broking.club/img/doc/testing/loadtest0.JPG)  
![loader1](http://broking.club/img/doc/testing/loadtest1.JPG)  
  
![cloudflare0](http://broking.club/img/doc/testing/cloudflare0.JPG)  
![cloudflare1](http://broking.club/img/doc/testing/cloudflare1.JPG)  
  
Please note that we use a virtual server by Netcup for development purposes.  
A stronger machine would not be worth its monthly cost just for stress testing the project.  
![machine specs](http://broking.club/img/doc/testing/server_specs.jpg)

{{{ ENDCONTENT }}}

{{{ DOCEND }}}
