{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Edit Profile

Version 1.3

{{{ STARTCONTENT }}}

# Use-Case Name 
Edit Profile
## 	Brief Description
A user can edit his profile. The user is able to change the passwortd, conform personal information and delete the account.

# Flow of Events
## 	Basic Flow
![Change password screenshot](http://broking.club/img/doc/screens/uc_changepassword.JPG)

### Change personal information

### Change password

### Delete Account

![Activity Diagram](http://blog.broking.club/wp-content/uploads/2014/10/Activity-Diagram-Edit-Profile.png)
[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/changepassword.feature"]]

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




