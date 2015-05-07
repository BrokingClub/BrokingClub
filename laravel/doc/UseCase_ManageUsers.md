{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Manage Users

Version 1.3

{{{ STARTCONTENT }}}

# Use-Case Name 
ManageUsers
## 	Brief Description
The admin can manage the users in the admin panel.

# Flow of Events
## 	Basic Flow

By choosing one user out of the list, the admin can edit the attributes of this user.

![Activity Diagram](http://broking.club/img/doc/ad/ad_ManageUsers.png)

TODO: WRONG FEATURE!

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/login.feature"]]


## 	Alternative Flows
### Values do not match the requirements
admin receives an error message.

# Special Requirements
*n.a.*

# Preconditions
## User registered to the system
To gain access to the usermanagement the user has to be registered to the system 

## User is admin in the system
To gain access to the usermanagement the user has to be an admin.

## Postconditions
*n.a.*

# Extension Points
*n.a.*

{{{ ENDCONTENT }}}

{{{ DOCEND }}}




