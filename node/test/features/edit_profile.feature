Feature: change the password of my account
	As a logged in user
	I want to conform my profile
	So I can correct my name or change my username
	
	Scenario: Enter valid first name and last name and an available username
		Given I am logged in as testuser
		And I enter the following text in first name: first_name
		And I enter the following text in last name: last_name
		And I enter the following text in username: new_username
		Then I should see "Profile has been updated"
		
	Scenario: I do not enter a valid first name or/and last name or/and username into the firstname field, the lastname field or the username field
		Given I am logged in as testuser
		And I enter the following text in first name: "%/&_not_a_valid_firstname:)" 
		And I enter the following text in last name: "&%not_a_valid_lastname(/"
		And I enter the following text in username: "!$§_not:a:valid:username"
		Then I should see "Non valid input!"	
		
	Scenario: I do not enter an available username into the username field
		Given I am logged in as testuser
		Given a user with the username "Peter" already exists
		And I enter the following text in first name: first_name 
		And I enter the following text in last name: last_name
		And I enter the following text in username: "Peter"
		Then I should see "Username already taken"	
		
	
	
		
Background: testuser has been added to the database
	Given the following users exist:
	|usename		| email					| 	password		|	firstname		| lastname					
	|testuser		| test@broking.club		|	old_password	|	Test			| User

	
	And I am on the BrokingClub edit profile page	