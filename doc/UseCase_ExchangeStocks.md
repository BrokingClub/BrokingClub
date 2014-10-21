{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Exchange stocks

Version 1.0

{{{ STARTCONTENT }}}

# Use-Case Name 
Exchange stocks
## 	Brief Description
The user can access the stock exchange system in order to buy or sell shares.
A quick overview can be achieved through the dashboard.

# Flow of Events
## 	Basic Flow
The user opens the stock exchange dashboard.  
A company or products share can be selected from a list.  
Choose from three available types:  
1. Standard  
2. Turbo (short)  
3. Turbo (long)
It is possible to specify the amount of shares.

Stocks can only be bought and sold within the trading hours. (e.g. 8am - 8pm)  
It is not allowed to enter a negative amount or zero shares to buy.
The liquidity of the user has to be checked against the final price.

If the transaction is successful a summary will be shown.

![Activity Diagram - Exchange stocks](http://blog.broking.club/wp-content/uploads/2014/10/Activity-Diagram-Stock-Exchange-System.png)

## 	Alternative Flows
### Outside trading hours
If a user tries to buy shares outside the regular trading hours he will be redirected to the stock exchange dashboard.

## Invalid amount
Negative values or zero are invalid amounts, an error message will be shown.

## Insufficient funds
If the user has not enough funds for the transaction he will be shown some alternatives to earn enough money.

# Special Requirements
*n.a.*

# Preconditions
## Inside trading hours
The stock exchange system can still be used outside trading hours but it is not possible to trade shares in this time interval.

## User is logged in
The user needs to be authenticated with the system in order to access the stock exchange system.

## Postconditions
*n.a.*

## 	Name of Extension Point
*n.a.*

{{{ ENDCONTENT }}}

{{{ DOCEND }}}




