{{{ TOC }}}


{{{ DOCSTART }}}

# Use-Case Specification: Manage Clubs

Version 1.2

{{{ STARTCONTENT }}}

# Use-Case Name 
Manage Clubs
## 	Brief Description
A user can manage his clubs. For the first version it will only be possible to leave a club for a user or a founder can change the description or dissolve a club.

# Flow of Events
## 	Basic Flow
The user opens the page 'manage clubs'.
If this user has no membership of any club, a list of the top clubs of the game will be displayed.
If the user is member of a club, it will be checked whether he is the founder of this club.
As a founder there is the opportunity to change the description or dissolve the club.
The basic member is able to leave the club.

Both activities require to be confirmed by the user. Only if this happened the server starts to verify the inputs of the user.


![Activity Diagram](http://blog.broking.club/wp-content/uploads/2014/10/ac_manageClubs.png)

## 	Alternative Flows
### No membership of any club
A user without any membership of a club is able to take a look on a list of all clubs. He can apply to them looking forward to be a member.

### Normal membership of a club
A clubmember is able to see all other members and their specifications.

### Founder of a club
A founder has got the right to change the displayed description of the club. He also can invite new members or dissolve the club.

# Special Requirements
*n.a.*

# Preconditions
## User is logged in
The user has to be authenticated in order to manage his clubs.

## Postconditions
*n.a.*

# Extension Points
*n.a.*

{{{ ENDCONTENT }}}

{{{ DOCEND }}}




