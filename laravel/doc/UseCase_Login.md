{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Login

Version 1.3

{{{ STARTCONTENT }}}
bla2

# Use-Case Name 
Login
## 	Brief Description
The user can login to the system 

# Flow of Events
## 	Basic Flow
![Login screenshot](http://broking.club/img/doc/screens/login.png)

By typing in the registered username with the correct password a user can login himself to the system.
The server checks whether the user is already activated and not blocked from the game. 
If this is not the case and the password is typed in correctly the user will be redirected to the dashboard.

![Activity Diagram](http://broking.club/img/doc/ad/ad_login.png)

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/login.feature"]]


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




