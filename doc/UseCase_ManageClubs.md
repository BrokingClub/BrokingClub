{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Edit profile

Version 1.2

{{{ STARTCONTENT }}}

# Use-Case Name 
Manage Clubs
## 	Brief Description
A user can manage his clubs. For the first version it will only be possible to leave a club for a user or a founder can change or dissolve a club.

# Flow of Events
## 	Basic Flow
The user opens the page 'manage clubs'.
If this user has no membership of any club, a list of the top clubs of the game will be displayed.
If the user is member of a club, it will be checked whether he is the founder of this club.
As a founder there is the opportunity to change the description of the club or dissolve the club.
The basic member is able to leave the club.

Both activities require to be confirmed by the user. Only if this happened the server starts to verify the inputs of the user.


![Activity Diagram](http://blog.broking.club/wp-content/uploads/2014/10/Activity-Diagram-Edit-Profile.png)

## 	Alternative Flows
### Incorrect password
The current password field will be highlighted and the user receives an error message.

### New password does not meet security requirements
The user will be told about the necessary security requirements for passwords.

### Confirmed password does not equal the new password
New and confirm password field will be highlighted.

# Special Requirements
*n.a.*

# Preconditions
## User is logged in
The user has to be authenticated in order to change his password.

## Postconditions
*n.a.*

# Extension Points
*n.a.*

{{{ ENDCONTENT }}}

{{{ DOCEND }}}




