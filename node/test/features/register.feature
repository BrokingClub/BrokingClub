Feature: Register to the system
  As a non registered user
  I want to register to the system
  So I can play the game

  Background:
    Given I am on the BrokingClub register page

  Scenario: Enter valid username, email and password (2x)
    When I enter the following text in username: "username"
    And I enter the following text in email: "email"
    And I enter the following text in password: "password"
    And I enter the following text in repeat_password: "password"
    And I click on register
    Then I should be redirected to the login page

  Scenario: I do not enter a valid username or a valid email address
    When I enter the following text in username: "not_a_valid_username"
    And I enter the following text in email: "not_a_valid_email"
    And I enter the following text in password: "password"
    And I enter the following text in repeat_password: "password"
    And I click on register
    Then I should see an error message