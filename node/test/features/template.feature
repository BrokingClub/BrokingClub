Feature: display list of movies filtered by rating
	As user
	I want to display all the filtered movies
	So I can see which movies are OK for me to watch
	
	Scenario: restrict to moviews with 'PG' or 'R' ratings
		Given I check the following ratings: PG,R
		And I uncheck the following ratings: PG-13,G
		And I press "Refresh"
		Then I should see "Bla Bla 1"
		And I should see "Bla Bla 2"
		And I should not see "Blub 1"
		And I should not see "Blub 2"
	
	Scenario: no ratings selected
		Given I uncheck all the ratings
		And I press "Refresh"
		Then I should see some movies
		
Background: movies have been added to database
	Given the following movies exist:
	|title		| rating	| 	release
	|Bla Bla 1	| PG		|	1992
	|Bla Bla 2	| PG		|	1991
	|Blub 1		| G			|	1993
	|Blub 2		| G			|	1993
	
	And I am on the RottenPotatoes home page
	
	