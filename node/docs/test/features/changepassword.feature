Feature: change the password of my account
	As a logged in user
	I want to change my login password
	So I can make it more secure or easy to remember
	
	Scenario: Enter the correct old password and the new password in the password and password repeat 
		Given I am logged in as testuser
		And I enter the following text in old password: old_password
		And I enter the following text in password: new_password
		And I enter the following text in password repeat: new_password
		Then I should see "Password has been changed."
		
	Scenario: I enter a wrong password into the old password field
		Given I am logged in
		And I enter the following text in old password: "Not a real password"
		And I enter the following text in password: new_password
		And I enter the following text in password repeat: new_password
		Then I should see "Wrong password!"	
		
	Scenario: Enter the correct old password but the new password and password repeat fields are not the same
		Given I am logged in as testuser
		And I enter the following text in old password: old_password
		And I enter the following text in password: new_password
		And I enter the following text in password repeat: "Not a real password"
		Then I should see "Your password confirmation does not match."	
	
		
Background: testuser has been added to the database
	Given the following users exist:
	|usename		| email					| 	password
	|testuser		| test@broking.club		|	old_password

	
	And I am on the BrokingClub edit profile page	