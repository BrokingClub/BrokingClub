Feature: edit the values of any stock
  As a logged in admin
  I want to edit any stock values
  So I can correct some mistakes or change wrong values

  Background:
    Given I am logged in as a admin
    And I am in the admin panel on the edit page of a chosen stock

  Scenario: Edit the informations with correct values
    When I enter the following text in name: "Apple"
    And I enter the following text in shortcut: "AAPL"
    And I click on submit
    Then I should see "Stock has been updated"