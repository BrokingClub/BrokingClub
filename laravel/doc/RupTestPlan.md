
{{{ TOC }}}

{{{ DOCSTART }}}
[[setvar key="title" value="RUP Test Plan"]]
[[setvar key="project" value="Broking Club"]]
[[setvar key="version" value="0.0.1"]]

# [[$title]]
* Project: __[[$project]]__
* Document Version: __[[$version]]__

{{{ STARTCONTENT }}}

# Introduction  
## Purpose  
The purpose of the Iteration Test Plan is to gather all of the information necessary to plan and control the test effort for a given iteration. It describes the approach to testing the software, and is the top-level plan generated and used by managers to direct the test effort.  
This Test Plan for Broking Club supports the following objectives:  
* Identifies the items that should be targeted by the tests.  
* Identifies the motivation for and ideas behind the test areas to be covered.  
* Outlines the testing approach that will be used.  
* Lists the deliverable elements of the test project.  
  
## Scope  
* Unit testing (PHPUnit)  
* Functional testing (Cucumber)  
* Load testing  
  
## Intended Audience
* Students  
* Professors
* Open-source enthusiasts  
  
## Document Terminology and Acronyms

# Evaluation Mission and Test Motivation
Testing is necessary to develop a high-quality product. Our customers want to use a professional web application/game.  
If a visitor encounters an error they might be tempted to leave.  
Changes in the source-code can break things, this is another reason to test the functionality of our application to make sure that the business logic still works as intended and expected after refactoring.
  
## Background
The test coverage of this project has continuously improved.  
We are a small team so we started by writing feature files in 'business-speak'.
These are backed by step-definitions (in JavaScript).
The interaction between the interface of our application and the user is secured via these tests.  
  
Next up unit tests have been implemented to test our business logic.
Unit tests are very common and highly supported in frameworks.
They also force you to separate your logic from the Models, Views and Controllers leading to cleaner source-code.  
  
In the last step performance and load tests have been executed.
The web application has to work even if hundreds or even thousands of visitors are sending requests.
It is also possible to learn about the scaling behaviour of your application by stress testing it.
  

 
## Evaluation Mission
* find as many bugs as possible
* find important problems, assess perceived quality risks
* advise about perceived project risks
* certify to a standard
* verify a specification (requirements, design or claims)
* advise about product quality, satisfy stakeholders
* advise about testing
* meet quality standards
* stable and robust product

## Test Motivators
* quality risks
* technical risks
* project risks
* use cases
* functional requirements
* non-functional requirements
* suspected failures

# Outline of Planned Tests
## Outline of Test Inclusions
* Functional tests
* Unit tests
* Performance tests

# Test Approach
Tests will be executed automatically with every commit to the project repository.
This does not apply to load testing because this would require a separate server in order to not disturb the production server.  
Test results will be send to the HipChat room and via Email.

## Testing Techniques and Types
### Function Testing
Function tests do not test the code itself but the behaviour of the application.
Customers can define feature files in plain text and developers implement these in step-definitions.  
Running the tests will check that the interaction with the application works as expected and required.  
  
All function tests are visible [here](http://node.broking.club/#/cucumber).  

**Technique Objective:**  
Verify that the application interface reacts as intended.

**Technique:**  
Execute each use-case scenario’s individual use-case flows or functions and features, using valid and invalid data, to verify that:
* the expected results occur when valid data is used
* the appropriate error or warning messages are displayed when invalid data is used
* each business rule is properly applied

**Oracles:**  
* Feature files
* Step definitions
Will be executed automatically with every commit by Travis CI.  

**Required Tools:**  
* [Cucumber](https://www.npmjs.com/package/cucumber)
* [NodeJS](https://nodejs.org/)
* [GitHub](https://github.com/)
* [Travis CI](https://travis-ci.org/BrokingClub/BrokingClub)

**Success Criteria:**  
Every feature file has its step-definition which needs to be executed without throwing an error.  

**Special Considerations:**  
Changes in the user interface may break step-definitions.  

### Load Testing
Load testing is a performance test that subjects the target-of-test to varying workloads to measure and evaluate the performance behaviors and abilities of the target-of-test to continue to function properly under these different workloads.  
The goal of load testing is to determine and ensure that the system functions properly beyond the expected maximum workload.  
Additionally, load testing evaluates the performance characteristics, such as response times, transaction rates, and other time-sensitive issues.  
  
The results can be seen on the bottom of [this page](http://broking.club/doc/?f=testing).  

**Technique Objective:**  
Exercise designated transactions or business cases under varying workload conditions to observe and log target behavior and system performance data.

**Technique:** 
* Flood database with randomly generated users and fake data.
* Simulate thousands of clients and requests to achieve a higher load than usual.
 
**Oracles:**  
The stress tests generate live reports and diagrams to inspect the outcome.  

**Required Tools:**  
* [Faker](https://github.com/fzaninotto/Faker) (to generate fake users/data)  
* [Loadtest](https://www.npmjs.com/package/loadtest) (npm package)
* [Loader](https://loader.io/) (cloud based load testing)

**Success Criteria:**  
The server should respond in less than 100ms while stress tests are being executed.  

**Special Considerations:**  
* Load testing should be performed on a dedicated machine or at a dedicated time. This permits full control and accurate measurement.
* The databases used for load testing should be either actual size or scaled equally.
* When load testing on the same machine the test itself should not exceed CPU usage of the application

### Installation Testing
Installation testing has two purposes.  
The first is to ensure that the software can be installed under different conditions such as a new installation, an upgrade, and a complete or custom installation under normal and abnormal conditions.
Abnormal conditions include insufficient disk space, lack of privilege to create directories, and so on.
The second purpose is to verify that, once installed, the software operates correctly.
This usually means running a number of the tests that were developed for Function Testing.

**Technique Objective:**  
Exercise the installation of the target-of-test onto each required hardware configuration under the following conditions to observe and log installation behavior and configuration state changes:
* new installation: a new machine, never installed previously with Broking Club
* update: a  machine previously installed Broking Club, same version
* update: a machine previously installed Broking Club, older version

**Technique:**  
* Write short and concise installation manual
* Send zipped installation package to target
* Extract, read and install

**Required Tools:**  
* [nginx](http://nginx.org/)
* [PHP](http://php.net/) >= 5
* [NodeJS](https://iojs.org) (io.js as long as the merge is not commplete)
* [Laravel](http://laravel.com/)

**Success Criteria:**  
* Project pages can be accessed via a browser
* Functional tests work
* Packages (composer & npm) can be installed
* NodeJS app can be started

**Special Considerations:**  
A successful installation depends on countless other things such as hardware and software.

# Deliverables

## Unit testing
*Local*
![PHPUnit](http://broking.club/img/doc/testing/phpunit.JPG?rand=3537)  
*Travis CI*
![Travis CI](http://broking.club/img/doc/testing/phpunit_travis.jpg?rand=9453)

## Test coverage
*CodeClimate*
![CodeClimate](http://broking.club/img/doc/testing/codeclimate_feed.jpg?rand=3603)  
*Badge (should be above 30%)*
[![Test Coverage](https://codeclimate.com/github/BrokingClub/BrokingClub/badges/coverage.svg)](https://codeclimate.com/github/BrokingClub/BrokingClub/coverage)

## Test log
*Today it is a fancy badge (should be green)*
[![Build Status](https://travis-ci.org/BrokingClub/BrokingClub.svg)](https://travis-ci.org/BrokingClub/BrokingClub)

## Notifications
*HipChat*
![HipChat](http://broking.club/img/doc/hipchat.jpg?rand=1568)  

## Performance testing
*npm loadtest*
![loadtest](http://broking.club/img/doc/testing/loadtest.jpg?rand=6720)  

![loader0](http://broking.club/img/doc/testing/loadtest0.JPG)  
![loader1](http://broking.club/img/doc/testing/loadtest1.JPG)  
  
![cloudflare0](http://broking.club/img/doc/testing/cloudflare0.JPG)  
![cloudflare1](http://broking.club/img/doc/testing/cloudflare1.JPG)  

{{{ ENDCONTENT }}}

{{{ DOCEND }}}

