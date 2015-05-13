
{{{ TOC }}}

{{{ DOCSTART }}}
[[setvar key="title" value="Software Architecture Document"]]
[[setvar key="project" value="Broking Club"]]
[[setvar key="version" value="1.0"]]

# [[$title]]
* Project: __[[$project]]__
* Document Version: __[[$version]]__

{{{ STARTCONTENT }}}


# Introduction


## Purpose

This document provides a comprehensive architectural overview of the system, using a number of different architectural views to depict different aspects of the system.  It is intended to capture and convey the significant architectural decisions which have been made on the system.

## Scope
The scope of this document is to depict the architecture of the online stockmarket game BrokingClub created by Simon Schneider, Philipp Schemel and Marc Vornetran.
Some parts of this documentation have been automatically created by our IDE PhpStorm. It can automatically convert PHP code into nice diagrams (data, class etc.).

## Definitions, Acronyms and Abbreviations

* ORM: object-relational mapping
* ERM: enterprise relationship mapping
* MVC: Model View Controller
* API: application programming interface 
* IDE:  integrated development environment

## References

* [Software Requirements Sepcification](?f=srs)
* [Use Cases](?f=usecases)
* [Architecture of Laravel by laravelbook.com](http://laravelbook.com/laravel-architecture/)


## Overview
This document includes information about various aspects of the architecture of the broking club game:
* Layers / Deployment view: How the physical and virtual parts of our development environment work together
* Logical view: Which concepts we use for structuring our code (buzzword MVC)
* Data view: How persistence is organized and realised in our project.

# Architectural Representation

# Architectural Goals and Constraints
This section describes the software requirements and objectives of the game BrokingClub. 

## Technical Platform
The application BrokingClub will be deployed on a nginx http server with NodeJS and PHP.
 
## Security
The system has to be secured by different methods, so the users can make online payments for example. 
Those security is provided by our MVC framework Laravel. Laravel provides facilities for strong AES encryption via the mcrypt PHP extension.
Laravel aims to make implementing authentication very simple. In fact, almost everything is configured for you out of the box.
We will not write the authentication system completely by hand, instead we will use the famous and secure Confide PHP-Package to build our authentication system on top. 

# Use-Case View
To see all of our use-cases you can check out the use case diagram: [Use case diagram](http://broking.club/img/doc/uc_diagram.png)

Our most significant use cases are:
* [Use Case: Login](?f=uc_login)
* [Use Case: Edit Profile](?f=uc_editprofile)
* [Use Case: Manage clubs](?f=uc_manageclubs)
* [Use Case: Exchange stocks](?f=uc_exchangestocks)

#  Implementation View

## Layers / Deployment view
For our system we need a database, a development environment, a version control, a deployment system and of course a web server for the enduser. 
This diagram illustrates how these layers work together.
![Deployment View](http://broking.club/img/doc/diagrams/deployment_view.png)

# Logical View
## Overview
The PHP Framework Laravel provides a clean implementation of the MVC-Concept. In the graphic below you can see how the controller, model and view parts are connected.
![Architectural Representation](http://broking.club/img/doc/diagrams/laravel_mvc_new.jpg)


## Architecturally Significant Design Packages
![Architecture Overview](http://broking.club/img/doc/diagrams/architecture_overview.png)


**Parts that were changed by refactoring**
![Refactored part](http://broking.club/img/doc/diagrams/architecture_overview_refactored.png)  
[Full size](http://broking.club/img/doc/diagrams/architecture_overview_refactored.png)  

# Data View (optional)
To store the data of our users and the transactions they started we need a good database planning. In this ERM you can see how the data will be structured in our game.
The stock values table will be filled by our NodeJS Tracker, that received the data from the Yahoo finance API. Persistence is realised via the Laravel ORM Eloquent.

![Data View](http://broking.club/img/doc/diagrams/data_view.png)

# Size and Performance
The performance of the system is very depended on the system it is running on. High bandwidth and fast page loading is important for a fluent gaming experience. 
Therefore we use a root server that runs a well performing Nginx webserver, which is capable to serve a large ammount of player at once. Laravel isn't the fastest Framework for 
big ammounts of requests, so we have to use caching to increase the speed of each pageload. 
Our first goal is to work with about 100 players at once without breaking the 1 second border per request.

# Quality
Our IDE and our Framework help us with our quality management. PhpStorm does automatic code reviews and Laravel is able to run Unit Tests. Our highly motivated and professional team
is also a guarantee for high quality code.
The packages that we use are well tested and have a bright future because of the big community surrounding Laravel. Like we described in the Security section we do not write the authentication system
completely by hand - we will use the famous Confide PHP-Package and build our authentication system arround it. 

  
{{{ ENDCONTENT }}}

{{{ DOCEND }}}

