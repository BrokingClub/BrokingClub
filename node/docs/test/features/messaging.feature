Feature: write another user a message
  As a logged in user
  I want to start a conversation with another user
  So he can read my message

  Background:
    Given I am logged in as a test user
    And I am one write message page

  Scenario: Send a valid message
    When I enter the following text in content: "Hallo Simon"
    And I click on submit
    Then I should see "Message has been sent."

  Scenario: Send an invalid message
    When I enter the following text in content: ""
    And I click on submit
    Then I should see "Please enter a message."