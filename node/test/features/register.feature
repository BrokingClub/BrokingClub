Feature: Register to the system
  As a non registered user
  I want to register to the system
  So I can play the game

  Scenario: Enter valid username, email and password (2x)
    Given I am not logged in
    And I enter the following text in username: username
    And I enter the following text in email: email
    And I enter the following text in password: password
    And I enter the following text in repeat_password: password
    Then I should be redirected to the login page

  Scenario: I do not enter a valid username or a valid email address
    Given I am not logged in
    And I enter the following text in username: not_a_valid_username
    And I enter the following text in email: not_a_valid_email
    And I enter the following text in password: password
    And I enter the following text in repeat_password: password
    Then I should see "Invalid inputs"

  Scenario: I do enter a valid username and a valid email adress, but the passwords are not matching
    Given I am not logged in and the account is not activated or blocked
    And I enter the following text in username: username
    And I enter the following text in email: email
    And I enter the following text in password: password
    And I enter the following text in repeat_password: an_other_password
    Then I should see "Passwords are not matching"




  Background:
    Given I am on the BrokingClub register page