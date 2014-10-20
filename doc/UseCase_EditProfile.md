{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Edit profile

Version 1.2

{{{ STARTCONTENT }}}

# Use-Case Name 
Edit Profile
## 	Brief Description
A user can edit his profile, for the first version it will only be possible to change the password.

# Flow of Events
## 	Basic Flow
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




