{{{ TOC }}}

{{{ DOCSTART }}}

{{{ STARTCONTENT }}}

# Patterns
Using patterns is a important task for modern software architects. We believe that you should think about the patterns you will use in your future project before it even starts.
Some of these patterns fit into your project some don`t. It heavily depends upon the size, time and complexity of your intentions.

## Knowledge about Patterns
Here we want to introduce some of the patterns that are vital when it comes to web development.

### Single Responsibility Principle
```
There should never be more than one reason for a class to change.
– Robert C. Martin: SRP: The Single Responsibility Principle
```
Classes that do not respect this pattern often include database, view (HTML) and calculation logic in one file. 
This makes objects complex and not *easy to change*. 

Small classes are more readable, easier to change, better to test and, most importantly, reusable.
This means that we have to create more logic to connect these classes, because they only fulfill one "simple" task. And we have to create more files.

### Interface Segregation Principle 
`Many client-specific interfaces are better than one general-purpose interface.`

When an interface becomes to large you should think about splitting it into different sub-interfaces.
Since we work with PHP that is known as a "non verbose" language interfaces are not used most of the time.
This principle is important if you use Java or other languages that are build around the usage of interfaces.

### Dependency Inversion Principle
`One should “Depend upon Abstractions. Do not depend upon concretions.`

High level modules should not depend on low level modules. Instead, both should only depend on abstractions (interfaces, contracts...). 
**One class should never depend on one concrete implementation**.
This allows is to decouple the code or in other words create code that is easy to maintain.

Bad designed code easily breaks when you change one part of it (spaghetti code). With the DIP we separate the code
into high and low level objects. The high level isn`t concerned with the details, this is what the low level is for. 



## Implementation

As we already said, the interface segregation principle works good for Java-projects or very large PHP applications. 
Of course interfaces are a part of PHP. But your code starts to look like verbose Java code and most of the times interfaces have only one concrete implementation (YAGNI).

The dependency inversion principle goes in the same direction. Although code readability is a strong factor in our project.

We decided that the SR-principle is the way to go. 

### Single Responsibility principle
Some of our classes grew over the course of the last semester. Especially the purchase model had a lot of logic that a simple model should not contain.

#### Changes in the software architecture (document)

!!TODO

#### Why / Pros
Our models contain some logic that should not be inside a simple MVC model. Since models are just the connection between the database values and the 
view it is not nice to have calculation logic inside them. 

It is easy to put code into models, but decreases readability and the system will be harder to maintain. 

This is wy we removed the mathematical formulas from the purchase model into services and repositories:
* BrokingClub/Purchase/Bill: A class that handles the pricing of a stock. It calculates the fee, the nett costs and the gross costs. A user will be charged by a certain amount if he buys stocks.
* BrokingClub/Purchase/Resale: A class that just works like the bill. But instead of handling the price of a purchase, it will calculate the offer for a sale.
* BrokingClub/Purchase/Bank: The bank tells you how much fees you have to pay
* BrokingClub/Repositories/PurchaseRepository: Has to be used to get purchases out of the database.
* BrokingClub/Repositories/StockRepository: Has to be used to get stocks out of the database. It contains some handy functions like "getByPurchase". So you don't have the logic for database relations inside your controller or even your model.
* BrokingClub/Cache/RepositoryCache: All the repositories that extend this class will automatically cache the database results (Small classes are awesome!)
* BrokingClub/Cache/StockValuesCache: We have a lot of stock values from each day inside our database. This is why we use a intelligent system to cache them effectively (Hit:Miss ratio is about 50:1) - this speeds up the system.

#### Cons
Like you see in the list above - we need a lot of classes for the single responsibility pattern. Certainly you can not have both small classes and few files, the code has to be somewhere.
However, we use an IDE that is intelligent enough that helps us to create classes very quickly and navigate fast.

Some may argue that small classes are harder to read, due to the fact that you have to look at a lot of files.
If you name your packages and classes correctly and in a language that is easy to understand for your domain, the project structure will stay easy to understand.

So instead of calling our classes feeCalculationService or earnedValuesProvider we used bank, bill, purchase, resale and so on  ;) 
Cou should know what a class does even if you don`t know its contents.

#### Testing
We had to relocate an essential part of our code: the stock purchase logic. Without it the game will become unfair und unplayable.
If a user has to pay more than another for the same kind of purchase just because of a false calculation, that`s a real problem.

This is why we have chosen unit testing to check if the purchase logic is still running during and after the refactoring:
* PurchaseTest
    * thestBillCorrect: check if the price calculation is still correct 
    * testAmountIsPositive: check if there is an error if the amount is negative
    * testNotExistingStock: error if you try to buy a stock that is not in the database
    * testFeeIsPositive: check if the fee is always positive
    * ...
* PlayerTest
    * testCharging: test if a player is charged after buying a stock
    * testChargeToHigh: test if a player cannot buy unlimited stocks
    * ...
    
For the creation of mockups we use a mockup factory:
```
$factory('Player', [
    'user_id' => User::orderBy(DB::raw('RAND()'))->first()->id,
    'balance' => rand(10000,50000),
    'firstname' => $faker->firstName(),
    'lastname' => $faker->lastName(),
    'created_at' => $faker->dateTime(),
    'updated_at' => $faker->dateTime()
]);

...

$factory('Purchase', [
    'stock_id' => Stock::orderBy(DB::raw('RAND()'))->first()->id,
    'player_id' => Player::orderBy(DB::raw('RAND()'))->first()->id,
    'value' => false,
    'fee' => false,
    'amount' => rand(1,100),
    'leverage' => array_rand([100 => 1, 350 => 1, 500 => 1]),
    'mode' => array_rand(['falling' => 1, 'rising' => 1])

]);
```

The test values are **not hard coded**.

[Further explanation in our test documentation](?f=testing)


#### UML
It is possible to create UML diagrams inside our IDE Jetbrains PhpStorm, just like in any other Jetbrains IDE.
The problem is that PHP does not support a strong type system. This makes the language very flexible and nice for rapid prototyping, but this behaviour is not good for creating UML diagrams automatically.

The only thing PhpStorm can draw is extensions and interfaces.
It is not possible to look the Laravel IoC container, even if we type hint the attributes like this:
```
class Purchase extends BaseModel
{
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
```

**The auto generated digram just looks like this**:
![Purchase UML auto generated](http://broking.club/img/doc/patterns/Refactoring_Purchase_PhpStorm.png)  


!! TODO

{{{ ENDCONTENT }}}

{{{ DOCEND }}}
