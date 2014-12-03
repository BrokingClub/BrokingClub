{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Login

Version 1.3

{{{ STARTCONTENT }}}
bla232

# Use-Case Name 
Login
## 	Brief Description
The user can login to the system 

# Flow of Events
## 	Basic Flow
![Login screenshot](http://broking.club/img/doc/screens/login.PNG)

By typing in the registered username with the correct password a user can login himself to the system.
The server checks whether the user is already activated and not blocked from the game. 
If this is not the case and the password is typed in correctly the user will be redirected to the dashboard.

![Activity Diagram](http://broking.club/img/doc/ad/ad_login.png)

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/login.feature"]]


## 	Alternative Flows
### Incorrect password or account is not active
user receives an error message.

# Special Requirements
*n.a.*

# Preconditions
## User registered to the system
To gain access to the game the user has tobe registered to the system 

## Postconditions
*n.a.*

# Extension Points
*n.a.*

{{{ ENDCONTENT }}}

{{{ DOCEND }}}




