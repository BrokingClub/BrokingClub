Feature: Login to the system
  As a registered user
  I want to login to the game
  So I can play game or update my profile

  Scenario: Enter valid username or email and password
    Given I am not logged in
    And I enter the following text in username: username
    And I enter the following text in password: password
    Then I should be redirected to the dashboard

  Scenario: I do not enter a username with the correct password
    Given I am not logged in
    And I enter the following text in username: not_my_username
    And I enter the following text in password: not_my_password
    Then I should see "Incorrect username, email or password."

  Scenario: I do enter a valid username with the correct passwort, but the account is not activated or blocked
    Given I am not logged in and the account is not activated or blocked
    And I enter the following text in username: username
    And I enter the following text in password: password
    Then I should see "Account is not activated or blocked"




  Background: username has been added to the database
    Given the following users exist:
      |usename		| email					| 	password		|	firstname		| lastname
      |username		| user@broking.club		|	password	    |	Test			| User


    And I am on the BrokingClub login page