### October 30, 2013 ###

We had 6 developers in attendance. The topic was OOP basics and terminology.

Group members, please submit pull requests to fill out this readme file and answer
questions.

Terminology:

Class - {description}
Object - {description}

In order to tell PHP to use inheritance, you use the ____ keyword.

To determine if inheritance makes sense, replace the word "     " with "   ". If
it still makes sense, then inheritance might be the right solution.

PHP has 3 visibility modifiers.

Public -
Protected -
Private -

It is typically a good/bad idea to do work in a constructor.

The purpose of an interface is to _

By writing code to use an interface, we gain a lot of power. We can inject the dependencies
of a class into it and then as long as we use only the methods defined in the interface,
we have a ton of things that the class can do without needing to know anything else about
the objects that were injected.


### Session Description ###
In the session, we created a few classes. A Leg class which had a move and stop method.

The exercise was to create a Dog class in such a way that represented an actual dog,
insomuch as it should (usually) have 4 legs and be able to respond to the commands
"come" and "stay".

The initial design had a Dog class which contained a constructor which initialized
an array of legs and then instantiated 4 new Legs and put them into the array.

The come and stay methods of the Dog class looped over the legs with foreach and told
the legs to move or stop respectively.

One of the first challenges was how can we create a dog with fewer (or more) than 4
legs, like Sparky the Wonder Mutt with the Heart of a Champion and three wobbly legs.

The first attempt at a solution was to have a method setNumberOfLegs which accepted an
argument that told the dog how many legs it has. However, it was soon discovered that
this alone was not sufficient to actually make a difference since it cannot be called
until after the dog is created. However, if it is called in the constructor, then it
can affect how many legs the dog has. So a parameter was added to the constructor that
controlled the looping and number of legs with a default of 4. This meant that all
normally constructed dogs still worked, but we could make Sparky like so:

$sparky = new Dog(3);

Other parts and concerns were dealt with including dealing with negative numbers or non
number (non integer really) arguments and how to deal with that. It was shown that
exceptions can be thrown in the constructor which will prevent an object from being
created if it fails validation. The amount of code in the constructor was rapidly growing.

The question was then posed, "How can I make an instance of the Dog class which has
other types of legs, for instance, TestLegs which log the fact that move or stop was
called on them?"

Many ideas were posed and we went with passing in a second parameter for the name of
the type of leg that should be instantiated (with a default of "Leg") and then
creating the type of object specified. Additional code was added to ensure that the
class existed and that it was an instanceof Leg.

At this point we jumped off and talked about interfaces. The Walkable interface was
created and we changed the various leg classes to implement Walkable instead of
extending the base Leg class.

At this point the Dog's constructor was getting rather complicated, but why not make
it more so? The next question was what could we do if the particular type of leg
needed constructor parameters. For instance the TestLeg class requires a path to
the log where the leg should log information.

The initial solution was to check the $legType parameter in the Dog class and if it
was a "TestLeg" then we'd create the leg and pass in the log path. This complicated
the Dog constructor more, but it worked.

The next question posed was what if we also have another class that requires configuration
after the fact, for instance a robot leg that doesn't have a power level set initially,
but requires a power level before move or stop can be called. Furthermore, the RobotLeg
class is provided by a third-party and we are not able to modify it. So another section
looking for RobotLeg was added to the constructor to deal with setting power levels if
the dog was told to build robot legs.

The continuing issue with the way we were building the class was that the constructor
was getting more and more complicated, it was doing work (which constructors should
usually not do) and it meant we'd have to modify the Dog class whenever we wanted it
to be able to use another type of Leg (Walkable) that was not a TestLeg, a RobotLeg or
a class that used either no constructor or a no parameter (or all default value)
constructor.

It was very apparent we needed a different solution, so the constructor was cleared
out and changed to take in an array called $legs. It was determined that building
and configuring the legs outside the dog and then passing them into the constructor
would allow us all sorts of power and flexibility. The constructor looped over the
array that was passed in. If the value being looped over was an instance of Walkable
then it was added to the $legs array.

In this way we were now able to simply create dogs with any sort of configuration of
any type or types of legs in any number we wanted. It did however, complicate the
caller's life a bit since the caller needed to send in the array of various Walkable
objects. We added Factory (and some other patterns) to the list of discussion points
for future sessions.

The code in this directory represents the code as it ended up at the conclusion of the
session. It was never actually run, so there's no guarantee that it is syntactically
valid. If you would like to make it runnable, please submit a pull request.
