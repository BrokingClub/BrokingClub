{{{ TOC }}}

{{{ DOCSTART }}}
[[setvar key="title" value="Software Requirements Specification"]]
[[setvar key="project" value="Broking Club"]]
[[setvar key="version" value="1.0"]]

# [[$title]]
* Project: __[[$project]]__
* Document Version: __[[$version]]__

{{{ STARTCONTENT }}}

# Introduction 

## Purpose 
This SRS describes the specifications for the stock-market game BrokingClub. A user can use the application in form of a webpage to buy stocks from the real market virtually. The document describes how a user can get from the login to actually buying a stock or joining others in a club.
We will specify how reliable and how fast the application should be and why we decided which Design constrains we used to optimize these behaviors.  
## Scope 
BrokingClub is a stock-market game, in which a player can easily buy real stocks with virtual money. You can join others in a club and try to manipulate opposing clubs using different actions. The service consists out of two parts: The landing page on which a user can get info about the game, register or contact the team, and the main application, where a user can work with his portfolio and interact with others.
## Definitions, Acronyms, and Abbreviations
The definitions listed beyond are used inside the document and are summarized versions of the respective Wikipedia article. If the reader does not understand the meaning of a special technical term, it is very likely that he will find help in this section.


* __Wikipedia__: Wikipedia is a free-access, free content Internet encyclopedia, supported and hosted by the non-profit Wikimedia Foundation (visit en.wikipedia.org for further information).
* __PHP__: PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language.
* __Laravel__: Laravel is a free, open source PHP web application framework, designed for the development of model–view–controller (MVC) web applications.
* __MySQL__: MySQL is (as of March 2014) the world's second most widely used open-source relational database management system (see RDBMS).
* __NodeJS__: Node.js is an open source, cross-platform runtime environment for server-side and networking applications.
* __Nginx__: Nginx (pronounced "engine-x") is an open source web server.
* __MTTR__ : Mean Time To Repair - how long is the system allowed to be out of operation after it has failed?
* __REST__: Representational state transfer (REST) is an abstraction of the architecture of the World Wide Web; more precisely, REST is an architectural style consisting of a coordinated set of architectural constraints applied to components, connectors, and data elements, within a distributed hypermedia system.
* __Yahoo! Finance__: Yahoo! Finance is a web site sponsored by Yahoo! that provides financial information and commentary with a focus on US markets.
* __CloudeFlare__: CloudFlare is a company which provides a content delivery network and distributed domain name server, sitting between the visitor and the CloudFlare user's hosting provider.


## References 

* [Use case diagram]( http://blog.broking.club/documentation/use-case-diagram/)
* [Use case: Login](http://broking.club/doc/?f=uc_login)
* [Use case: Change password](http://broking.club/doc/?f=uc_changepassword)
* [Use case: Manage clubs](http://broking.club/doc/?f=uc_manageclubs)
* [Use case: Exchange stocks](http://broking.club/doc/?f=uc_exchangestocks)

> TODO: Add the rest

## Overview
> TODO: Write a nice overview about the contents of this srs

# Overall Description 
## Product perspective
The Product could be monetized with premium coins that a player can spent on special club actions and buy stocks without spending some of his budget. It should always be possible to play this game for free without any strong restrictions.
## Product functions
BrokingClub can be seen as a game, but with an educational part. You can improve your knowledge about the way money works and especially about the stock market by playing the game. In the first place the game should make fun, and also is should be a bit addicting to the player. 
## User characteristics
Brokingclub can be played anywhere, as long as you have an internet connection. Because of its expected simplicity it’s a game for the average gamer for now and then. But also it is possible to play the game for a longer period of time, because of the strong competition and organization in clubs.
## Constraints
The user needs an internet connection. Modern smartphones and mobile internet-filtrates allows nearly every end-user to use the software everywhere. All the player needs for playing BrokingClub is a browser, and the basic knowledge of how to use a website.
In this first state we will not provide an Android or iOS Version of the game, because of its browser cross-compatibility.  
## Assumptions and dependencies
For an effective and economic development process we will use several free and open-source libraries. These dependencies have to be well-maintained and flexible.
## Functionality
__Use case diagram:__
![Use case diagram](http://blog.broking.club/wp-content/uploads/2014/10/Use-Case-Diagram1.png)

### Landing Page (Login / Logout)
The landing page of the game gives a short introduction into the game and the opportunity to login or register an account.  
[Use Case](http://broking.club/doc/?f=uc_login)
### Register
If you are going to register a new account you just have to put in a few personal information, an username and a valid e-mail address.  
### Profile (Forgot Password, Avatar, enter a Club)
For your account you can change and add some information about yourself. You can upload an avatar, which is shown on your profile. Also in your profile settings you can manage your membership in a club or enter an other one.  
[Use Case: Change password](http://broking.club/doc/?f=uc_changepassword)
### Create and update Clubs
An essential part of the game is to found or enter clubs. Clubs are a group of members working together. They can plan their activities and compete against other clubs.  
[Use Case](http://broking.club/doc/?f=uc_manageclubs)
### Manipulate other Clubs with Actions
Clubs are able to manipulate other ones with special actions. For example you can send a thief, who is trying to steal some money of other clubs or players. This action could fail, too. In this case the club sending this thief has to pay a penalty.
### Messaging system between Users and Clubs
Our game will give the function of an own messaging system between single players or clubs. This messaging system is thought for a simple and fast communication.
### Ranking
The ranking depends on the portfolio performance. It is the percentage of the money earned in relation to the seed money.
### Communicate with the real stock market
Our stock exchange system synchronizes itself with the real values of the stocks on the real world. So our stocks are real-timed.  
[Use Case: Exchange stocks](http://broking.club/doc/?f=uc_exchangestocks)
### Admin Panel
A panel where special users can edit Users, add new stocks to update and force the maintenance mode.
### Forum to give tips 
On top of that there will be a user forum, where you can ask questions or describe problems with the application to the community to gain some help. 

## Usability 
### Using a browser
The user has to know how to open and work with a modern browser like Chrome, Firefox or Opera.
### Speaks English
Our game is based on the english language. So it is necessary to understand all the content. 
### A sense for how to spend money 
If you want to be successful in this game of course you need to have a sense for spending money. If you have no idea how stock systems work or how to spend your money in the right way, you can play our game either. Then you just need to join a famous club with players they know how to do this.
## Reliability
### Server availability 
Our server-provider “netcup.de” promise a 99% uptime of the server.
### Failures during development 
During the closed alpha state, failures are common. After the public release the development should take place at a different environment to reduce this rate.
### MTTR should be low
Because of a high code quality presumed by the Framework Laravel. 
## Performance
### Reaction time
A Page should not be higher react slower than 3 seconds. Otherwise users will get distracted.
### Use caching 
We will use caching in our database, the template and by using cloudflare, to allow about 1000 users (using the current server environment)
### Resource utilization
The required disk-volume is 300MB for the Application, 1 MB for every User (avatar, database) and 200MB for the database to store the stock values. Caching reduced the CPU usage to a minimum. Cheap internal memory can be purchased if needed.  
## Supportability
### Support for languages
PHP and NodeJS are well supported Languages, and have a safe support for the next 10 years.
### Support for dependencies
Laravel is a very popular PHP Framework, support is guaranteed. The other dependencies are also well-known and easy to update using a command line tools like composer.
### Conventions
Laravel provides strict and well-tested conventions
## Design Constraints
### PHP
### NodeJs (Javascript)
### Laravel (with all packages it depends on)
### Github
### Dploy.io
## On-line User Documentation and Help System Requirements
There should be a help section inside the application. Short and easy texts and images should help to understand how to perform a certain action. 
Also the official forum could be used to ask questions. During the open beta, users can ask questions directly to the team.
## Purchased Components
* Domain www.broking.club (11€ per year)
* Server (5€ per month)
* Design from themeforest (20$ once)

## Interfaces

### User Interfaces
In this first state we will not provide an Android or iOS Version of the game, because of its browser cross-compatibility. Therefore a responsive design is key to a successful mobile usage experience. 
The interface will be split up into two different designs:

* _The Landing Page_: If a guest visits www.broking.club via a search engine or a recommendation he will see information’s about the game and an area for registration or login in form of a one-page designed Website.
* _The Game Panel_: A logged in user can access the game panel. On a sidebar on the left he can jump from one action to another. The main area on the right shows statistics, forms to buy stocks or edit sets of data (like profile, club or the portfolio) and the ranking.

### Hardware Interfaces
The software runs on a rented server, on which an Nginx-server system manages the traffic. It is possible to access this environment with every free device that is connected to the internet.
### Software Interfaces 
For the up-to-date stock values we need an interface to get these values into our own database. Therefore we will use the free Yahoo-finance API. It provides us 100.000 free stock requests per day, so we can deliver real data every 5 to 10 minutes to our users.
A social-authentication (an easy way to register with just the one mouseclick), such as facebook, google+ or github, is also planned for the near future. 
### Communications Interfaces 
NodeJs Server for communicating with the Yahoo API.
### Licensing Requirements, Legal and Copyright
Our applications source code is available to the public via github.com. This is why we use the “Creative Commons - Attribution-NonCommercial-ShareAlike 4.0 International”-License. 
For more information about this open license check http://creativecommons.org/licenses/by-nc-sa/4.0. 
Our dependencies are free and allow commercial usage:

* Laravel: https://github.com/laravel/laravel#license
* jQuery: https://jquery.org/license/
* NodeJs: https://raw.githubusercontent.com/joyent/node/v0.10.32/LICENSE
* Only our free yahoo finance license is restricted to 100.000 requests per day.

### Applicable Standards
Our Product delivers Websites using the HTML5 standard, which is known for its usability, interoperability, and internationalization. Because of this Web standard every User can easily access the website. We will not use any SEO-unfriendly techniques like Adobe Flash or Java-Applets. 
The routing system is based on a REST-architecture, so users and search engines can travel through the website in a clearly structured, modern and elegant way.

# Supporting Information 
Our complete documentation can be visited via: [http://blog.broking.club/documentation/ ](http://blog.broking.club/documentation/)

{{{ ENDCONTENT }}}

{{{ DOCEND }}}

