{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Manage Stocks

Version 1.3

{{{ STARTCONTENT }}}

# Use-Case Name 
ManageStocks
## 	Brief Description
The admin can manage the stocks in the admin panel.

# Flow of Events
## 	Basic Flow

![Login screenshot](http://broking.club/img/doc/screens/scr_managestocks.PNG)
An administrator is able to create a new stock by entering the symbol and the name of the stock. Also a
category has to be selected out of the list. 
The categories of the different stocks can be managed on the same page. New categories can be added, and
existing categories can be removed from the system. 
At the bottom of this page there is a list of all stocks in the system with an overview
about the names, symbols and categories of the stocks. Those stocks can be directly in this list
removed from the system.

![Activity Diagram](http://broking.club/img/doc/ad/ad_ManageStocks.png)

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/managestocks.feature"]]


## 	Alternative Flows
### Values do not match the requirementsN
Admin receives an error message.

# Special Requirements
*n.a.*

# Preconditions
## User registered to the system
To gain access to the stockmanagement the user has to be registered to the system 

## User is admin in the system
To gain access to the stockmanagement the user has to be an admin.

## Postconditions
*n.a.*

# Extension Points
*n.a.*

{{{ ENDCONTENT }}}

{{{ DOCEND }}}




