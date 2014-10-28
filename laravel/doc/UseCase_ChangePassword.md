{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Change password

Version 1.3

{{{ STARTCONTENT }}}

# Use-Case Name 
Change password
## 	Brief Description
A user can change his password by entering his current one and confirming the new password.

# Flow of Events
## 	Basic Flow
![Change password screenshot](http://broking.club/img/doc/screens/uc_changepassword.JPG)

The user opens the edit profile page.  
In order to change the password the current password has to be filled.  
Next up the new password can be entered and confirmed in two separate text boxes.  
A click on a button will send the action to the server.  

The server will verify this action in three steps:  
1. Current password will be verified  
2. New password will be checked against the security requirements  
3. Confirmed password needs to equal the new password  

If the entered information is correct the user will receive a confirmation message that the password has been changed.

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




