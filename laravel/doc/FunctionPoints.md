{{{ TOC }}}

{{{ DOCSTART }}}

{{{ STARTCONTENT }}}

# Function Points
Here we show you the result of our estimation and the way that we used to calculate these function point based estimations.


## Reasons for different calculation
We had to redo our calculation because the „tiny tools“ missed some variables that we surely needed.
Because we are hardcore Javascript professionals we went through the (very bad written) Javascript code at tiny tools. Now we have an awesome excel sheet with exactly the same formula and weightings.
Here is how the calculate code of tiny tools looks like:

```
function fProj_FPCalc(){
var iEntryStatus=fValidValues();

if (iEntryStatus==1){
var iCountTotal = fFindCountTotal();
var iTotalCAV = fAdjScaleSum();

document.Form_FPResult.tProjFP.value = iCountTotal * (0.65 + (0.01 * iTotalCAV));
}
```

*fAdjScaleSum* is the result of your complexity table. You can set a breakpoint and copy it out of the variable – ours is **33**.
Inside the *fFindCounTotal* you will find the weighting of each factor. Finally this calculation `iCountTotal * (0.65 + (0.01 * iTotalCAV))` will give you the final result for every usecase.

## Function points vs effort
![FP Graph](http://broking.club/img/doc/functionpoints/FP Graph.JPG)

**Outliers:** Like you can see in this graph we have some outliers. For the reasons why they exist please check the corresponding FP calculation.


![Calculation for graph](http://broking.club/img/doc/functionpoints/Usecases FPs.JPG)

## Use cases

### Semester 3 (done before calculation)

#### Login

![Login](http://broking.club/img/doc/functionpoints/Login.JPG)


#### Register

![Register](http://broking.club/img/doc/functionpoints/Register.JPG)

#### Edit profile

![Edit Profile](http://broking.club/img/doc/functionpoints/edit profile.JPG)

#### Exchange stocks

![Exchange stocks](http://broking.club/img/doc/functionpoints/Exchange stocks.JPG)

#### Manage clubs

![Manage clubs](http://broking.club/img/doc/functionpoints/manage clubs.JPG)

### Semester 4 (done after calculation)

#### Backend: user editing
![Backend user editing](http://broking.club/img/doc/functionpoints/Backend user editing.JPG)


#### Backend: stock management
![Backend stock management](http://broking.club/img/doc/functionpoints/Backend stock management.JPG)

#### Messaging
![Messaging](http://broking.club/img/doc/functionpoints/Messaging.JPG)


#### Roleplay
![Roleplay](http://broking.club/img/doc/functionpoints/Roleplay.JPG)


#### Ranking and statistics
![Ranking and statistics](http://broking.club/img/doc/functionpoints/Ranking and statistics.JPG)


{{{ ENDCONTENT }}}

{{{ DOCEND }}}
