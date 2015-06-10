Feature: change the personal information of my account
  As a logged in user
  I want to edit my profile
  So I can correct my name or change my username
	
  Background:
    Given I am logged in as a test user
    And I am on the profile page
    
    Scenario: Enter valid first name and last name and an available username
      When I enter the following text in first name: "John"
      And I enter the following text in last name: "Doe"
      And I click on submit
      Then I should see "Profile has been updated"
		
    Scenario: I do not enter a valid first name or/and last name or/and username into the firstname field, the lastname field or the username field
      When I enter the following text in first name: "%/&_not_a_valid_firstname:)" 
      And I enter the following text in last name: "&%not_a_valid_lastname(/"
      And I click on submit
      Then I should see an error alert