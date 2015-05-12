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

![Login screenshot](http://broking.club/img/doc/screens/scr_manageusers.PNG)

On the overview of the users an admin can see immediately some basic informations like
the UserID and the username but also the role of the user, whether he is just a normal
user or an administratior of broking.club.
With one click an admin can open an user's profile in a new tab with the button on the right.
The yellow button opens the view to edit all informations about one user. Editable for an administrator
are the full name, the mail, the username, the role, the chosen career, the membership and the role of a club,
the total balanace and the experience points.

![Activity Diagram](http://broking.club/img/doc/ad/ad_ManageUsers.png)

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/manageusers.feature"]]


## 	Alternative Flows
### Values do not match the requirements
Admin receives an error message.

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




