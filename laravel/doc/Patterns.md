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

### Interface Segregation Principle (Schnittstellenaufteilungsprinzip)
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

** !! TODO **

### Single Responsibility principle

#### Changes in the software architecture (document)

#### Why

#### Pros

#### Cons

#### Testing

#### UML

{{{ ENDCONTENT }}}

{{{ DOCEND }}}
