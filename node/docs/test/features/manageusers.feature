Feature: edit the values of any user
  As a logged in admin
  I want to edit any users profile
  So I can correct some mistakes or change wrong values

  Background:
    Given I am logged in as a admin
    And I am in the admin panel on the edit page of a chosen user

  Scenario: Edit the informations with correct values
    When I enter the following text in first name: "John"
    And I enter the following text in last name: "Doe"
    And I click on submit
    Then I should see "Profile has been updated"