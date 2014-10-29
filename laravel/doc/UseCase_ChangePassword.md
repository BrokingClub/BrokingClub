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
The username can be changed by typing in a new one in the right text box. 
A user is able to change personal information like the first and the last name. Those names are going to be typed in seperated text boxes. 
If the user confirms the changes with the button, the names have to match the restrictions: 
- username has to be unique
- Only allowed signs in the names (e.q. no numbers)

![Activity Diagram](http://broking.club/img/doc/ad/ad_userInfo.png)

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/edit_profile.feature"]]

### Change password
For changing the password the application needs the current password. 
The user has to type in the new password twice. 
If those changes are confirmed by the user, it will be checked whether the current password is the right one and the twice typed in new passwort matches together.

![Activity Diagram](http://broking.club/img/doc/ad/ad_changePassword.png)

[[include url="https://raw.githubusercontent.com/BrokingClub/BrokingClub/master/node/test/features/changepassword.feature"]]

### Delete Account
Deleting an user account requires the current password.
After the password is checked the account is successfully deleted from the application.

![Activity Diagram](http://broking.club/img/doc/ad/ad_deleteAccount.png)

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




