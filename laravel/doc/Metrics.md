{{{ TOC }}}

{{{ DOCSTART }}}

{{{ STARTCONTENT }}}

# Metrics

## Test coverage
In software programming test coverage (also known as code coverage) describes a metric used to determine if source code is completely covered by its test suite.  
We decided to use the service [CodeClimate](https://codeclimate.com/github/BrokingClub/BrokingClub) which is free for open-source projects on GitHub.  
Every build which Travis runs generates test data which is then sent to CodeClimate. The service monitors the state of test coverage and calculates changes which will be displayed in the feed:  
![CodeClimate feed](http://broking.club/img/doc/testing/codeclimate_feed.jpg)  
  
The feed page can be easily forgotten and metrics could get worse without anyone noticing, therefor notifications will be pushed to our team collaboration software [HipChat](https://www.hipchat.com/):  
![HipChat](http://broking.club/img/doc/hipchat.jpg)  
  
Our current status is availabe on our [GitHub repository](https://github.com/BrokingClub/BrokingClub) page and via the badges provided by CodeClimate:  
[![Test Coverage](https://codeclimate.com/github/BrokingClub/BrokingClub/badges/coverage.svg)](https://codeclimate.com/github/BrokingClub/BrokingClub/coverage)  
If you are interested in more details feel free to visit our [CodeClimate feed](https://codeclimate.com/github/BrokingClub/BrokingClub).

{{{ ENDCONTENT }}}

{{{ DOCEND }}}
