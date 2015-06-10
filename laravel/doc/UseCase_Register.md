{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Register

Version 1.3

{{{ STARTCONTENT }}}


# Use-Case Name 
Register
## 	Brief Description
A guest can register an user account to login to the system.

# Flow of Events
## 	Basic Flow
![Login screenshot](http://broking.club/img/doc/screens/reg_screen.PNG)

By typing in an available username, a valid e-mail address and a password two times, a guest can register himself to the broking.club.
After completing the registration process the user will be redirected to the login page. 

![Activity Diagram](http://broking.club/img/doc/ad/ad_register.png)

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/docs/test/features/register.feature"]]


## 	Alternative Flows
### Invalid username e.g. with special symbols
user receives an error message.

### Invalid email 
If the entered email does not match the restrictions, the user will receive an error message.

### Passwords do not match
If the two entered passwords do not match, the user will receive an error message.

# Special Requirements
*n.a.*

# Preconditions
## User is on register site
User is not logged in and on the register site

## Postconditions
*n.a.*

# Extension Points
*n.a.*

{{{ ENDCONTENT }}}

{{{ DOCEND }}}




