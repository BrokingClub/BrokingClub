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

By choosing one stock out of the list, the admin can edit the attributes of this stock.
The admin can also add a new stock bei clicking the "Add stock" button. Then he has to type in the required
values to add a new stock.

![Activity Diagram](http://broking.club/img/doc/ad/ad_ManageStocks.png)

TODO: WRONG FEATURE!

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/managestocks.feature"]]


## 	Alternative Flows
### Values do not match the requirementsN
admin receives an error message.

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




