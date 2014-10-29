Feature: delete my user account
  As a logged in user
  I want to delete my user account
  So I can finish the addiction to the game

  Scenario: Enter the correct password
    Given I am logged in as testuser
    And I enter the following text in current_password: current_password
    And I submit the deletion
    Then I should see "User account has been deleted"

  Scenario: Enter a wrong password
    Given I am logged in as testuser
    And I enter the following text in current_password: another_word
    And I submit the deletion
    Then I should see "Wrong password"


  Background: testuser has been added to the database
    Given the following users exist:
      |usename		| email					| 	password
      |testuser		| test@broking.club		|	old_password


    And I am on the BrokingClub edit profile page