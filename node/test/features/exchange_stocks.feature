Feature: Exchange stocks
    As a user
    I want to buy and sell stocks on the market
    So I can earn money and get rich
    
    Scenario: Successful transaction of shares
        Given I am on the exchange system dashboard
        When I select long as the type
        And enter 1 as the amount to buy
        And I click on buy shares
        Then I should see the bought shares
        
    Scenario: Invalid amount to buy
        Given I am on the exchange system dashboard
        When I enter 0 as the amount to buy
        And I click on buy shares
        Then I should see an error message
        
    Scenario: Outside trading hours
        Given I am on the exchange system dashboard
        And the time is between 10pm and 8am
        When I buy shares
        Then I should see an error message
        
    Scenario: Insufficient funds
        Given I am on the exchange system dashboard
        And my funds are 0
        When I buy shares
        Then I should see an error message