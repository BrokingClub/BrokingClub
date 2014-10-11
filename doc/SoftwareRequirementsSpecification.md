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
* __PHP__: PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language.
* __MySQL__: MySQL is (as of March 2014) the world's second most widely used open-source relational database management system (see RDBMS).
* __NodeJS__: Node.js is an open source, cross-platform runtime environment for server-side and networking applications.
* __Nginx__: Nginx (pronounced "engine-x") is an open source web server.
* __MTTR__ : Mean Time To Repair - how long is the system allowed to be out of operation after it has failed?
* __Yahoo! Finance__: Yahoo! Finance is a web site sponsored by Yahoo! that provides financial information and commentary with a focus on US markets.
## References 
* [Use case diagram]( http://blog.broking.club/documentation/use-case-diagram/)
* [
## Overview
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

## Requirements subsets

# Specific Requirements 
## Functionality
__Use case diagram:__
![Image of Yaktocat](http://blog.broking.club/wp-content/uploads/2014/10/Uc_diagram.png)

### Landing Page (Login / Logout)
### Register
### Profile (Forgot Password, Avatar, enter a Club)
### Create and update Clubs
### Manipulate other Clubs with Actions
### Messaging system between Users and Clubs
### Ranking
### Communicate with the real stock market
### Admin Panel (Edit Users, Add new stocks to update, maintenance mode)
### Forum to give tips 

## Usability 
### Knows how to open and work with a browser
### Speaks English
### A sense for how to spent money 
## Reliability 
### Server availability (netcup.de promise a 99% uptime)
### Failures during development (Closed Alpha) are common
### MTTR should be low
Because of a high code quality presumed by the Framework Laravel. 
## Performance
### Reaction time of every Page should not be higher than 3 seconds
### Use caching (database, template, cloudflare) to allow about 1000 users (using the current server environment)
### ~300MB for the Application, ~1 MB for every User (avatar, database), ~200MB for the database to store the stock values 
* Response time for a transaction (average, maximum)
* Throughput, for example, transactions per second
* Capacity, for example, the number of customers or transactions the system can accommodate
* Degradation modes (what is the acceptable mode of operation when the system has been degraded in some manner)
* Resource utilization, such as memory, disk, communications, and so forth.
## Supportability

### PHP and NodeJS are well supported Languages, and have a safe support for the next 10 years
### Laravel is a very popular PHP Framework, support is guaranteed
### Laravel provides strict and well-tested conventions
### The dependencies are well-known and easy to update

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
* The Landing Page: If a guest visits www.broking.club via a search engine or a recommendation he will see information’s about the game and an area for registration or login in form of a one-page designed Website.
* The Game Panel: A logged in user can access the game panel. On a sidebar on the left he can jump from one action to another. The main area on the right shows statistics, forms to buy stocks or edit sets of data (like profile, club or the portfolio) and the ranking.
### Hardware Interfaces
The software runs on a rented server, on which an Nginx-server system manages the traffic. It is possible to access this environment with every free device that is connected to the internet.
### Software Interfaces 
For the up-to-date stock values we need an interface to get these values into our own database. Therefore we will use the free Yahoo-finance API. It provides us 100.000 free stock requests per day, so we can deliver real data every 5 to 10 minutes to our users.
A social-authentication (an easy way to register with just the one mouseclick), such as facebook, google+ or github, is also planned for the near future. 
### Communications Interfaces 
NodeJs Server for communicating with the Yahoo API.
### Licensing Requirements
### Legal, Copyright, and Other Notices
### Applicable Standards
# Supporting Information 

{{{ ENDCONTENT }}}

{{{ DOCEND }}}

