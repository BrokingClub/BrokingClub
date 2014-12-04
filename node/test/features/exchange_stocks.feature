Feature: Exchange stocks
    As a user
    I want to buy and sell stocks on the market
    So I can earn money and get rich
    
    Background:
        Given I am on the change system dashboard
        And I click on the "Google Inc." shares
    
    Scenario: Successful transaction of shares
        When I enter 1 as the amount to buy
        And I click on buy shares
        Then I should see a success message
        
    Scenario: Invalid amount to buy
        When I enter 0 as the amount to buy
        And I click on buy shares
        Then I should see an error message
        
    Scenario: Insufficient funds
        When I enter 9999999 as the amount to buy
        And I click on buy shares
        Then I should see an error message