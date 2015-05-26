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

## Trends (Code Quality and Churn)
Code churn is defined as lines added, modified or deleted to a file from one version to another.
In this graphic we can see the churn rate and the code quality of certain files in one graph. There is no clear correlation visible.
![CodeClimate Trends](http://broking.club/img/doc/metrics/Trends.JPG)  

## Issues / Bug Risks / Duplicates
Code climates uses this page to show in which files bugs and missing quality is hidden.
![CodeClimate Issues](http://broking.club/img/doc/metrics/Issues.JPG)  

The duplication page tells us that we have duplicate code in some config files. These duplications are intentional, because we use different database credentials for every environment (test, staging, development...).
![CodeClimate Duplicates](http://broking.club/img/doc/metrics/Duplication.JPG)  

## Lines of Code per hour

We calculate the lines of code associated to our YouTrack issues automatically.  
This is possible because the commit messages on our GitHub repository include the Task number linking back to YouTrack.  
You can view the result [here](http://node.broking.club/#/linesofcode) or take a look at the source code to use it for your own project [here](https://github.com/marc1404/LinesOfCode).
![Lines of code](http://broking.club/img/doc/metrics/linesofcode.JPG)

# Refactoring Metrics

## Before
![Purchase part before refactoring](http://broking.club/img/doc/patterns/Refactoring_Before.jpg)  
[Full Size](http://broking.club/img/doc/patterns/Refactoring_Before.jpg)

[Purchase Class before](https://github.com/BrokingClub/BrokingClub/blob/39847ba8bbaedea9dde514a741f692cbc0519c27/laravel/app/models/Purchase.php)
![Purchase Metrics Before Refactoring](http://broking.club/img/doc/metrics/Purchase_before.JPG)


## After
![Purchase part after refactoring](http://broking.club/img/doc/patterns/Refactoring_After.jpg)  
[Full Size](http://broking.club/img/doc/patterns/Refactoring_After.jpg)

[Purchase Class after](https://github.com/BrokingClub/BrokingClub/blob/master/laravel/app/models/Purchase.php)
![Purchase Metrics After Refactoring](http://broking.club/img/doc/metrics/Purchase_after.JPG)

## Explanation
By using the "single responsibility principle" the code complexity per file decreases drastically.

Code snippet for calculating a bill before refactoring:
```
public function calculateBill(){
        $stock = Stock::findOrFail($this->stock_id);
        $fee =      $this->calculateFee($stock);
        $price =    $this->calculatePrice($stock);
        $total =    intval($price + $fee);
        $perStock = $total / $this->amount;
        $bill = [
            "fee" => $fee,
            "price" => $price,
            "perStock" => $perStock,
            "total" => $total
        ];
        $bill = array_map(function($double){ return round($double, 4); }, $bill);
        return $bill;
    }
```

And after (with dependency injection and SRP applied):
```
    /**
     * @var Bill
     */
    public $bill;
    /**
     * @var Resale
     */
    public $resale;
    /**
     * @var CalculationService
     */
    private $calculator;

    public function __construct(array $attributes = array())
    {
        $this->calculator = App::make('CalculationService');
        $this->bill = $this->calculator->bill($this);
        $this->resale = $this->calculator->resale($this);
        parent::__construct($attributes);
    }
    
    ...
    
    /**
     * @return Bill
     */
    public function bill()
    {
        return $this->bill;
    }    
```

{{{ ENDCONTENT }}}

{{{ DOCEND }}}
