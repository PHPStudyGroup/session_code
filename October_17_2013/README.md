### October 17, 2013 ###

We had 3 developers in attendance for this session. We discussed what a dependency
is and how your can increase the testability of a class by providing the class with
its dependencies rather than have the class create its own dependencies.

The MailerInterface was created as an example of the types of methods that a class
that sends mail might have or need.

We created a controller that uses a class that implements the MailerInterface to
"send" email. The mailIt method in the Controller would be the method that actually
sends the email.

However, we don't have a class that actually sends the mail, but that doesn't stop us
from testing that the mailIt method works and sends in the values that it should.

So the ControllerTest class was created (please ignore the names of these classes, they
should not be taken as a MVC type controller.

The ControllerTest class was created as a basic unit test, extending
PHPUnit_Framework_TestCase.

The setUp method is a special method in phpunit test cases. It is run before each and
every test that is run. In our case, it creates a new instance of the Controller class
and creates a mock object for the MailerInterface interface.

We talked about how methods in PHPUnit are considered to be tests. If the method name
itself starts with "test" then the method is considered a test. Also, if the doc block
comments contain the @test annotation, then it will be considered a test. Personally,
I tend towards the annotation since it saves me 4 characters on the method names which
are typically pretty long anyway. The test method names tend to be long as they should
usually read like a sentence. This allows you to run phpunit with the --testdox option
which prints out the results of the unit tests like you were reading a list of software
specifications with checkboxes indicating if the specification is implemented.

For instance, public function startingScoreOfBowlingGameIsZero would output something like

[x] Starting score of bowling game is zero

We also talked about dataProvider tests which are indicated with the @dataProvider
annotation. The argument following is the name of the method that will provide parameters
to the test method. It is expected that the method will return an array of arrays, with
the inner array being the parameters that will be passed into the test method in the
order that they will be passed in.

The mailerIsSetAppropriately test is an example of a test that uses a data provider.
The mailFunctionProvider method provides parameters for 3 runs of the test. Using
data providers allows a single test to run through multiple input values and make
sure your code runs as expected for all of them.

In our code, it configures the mock object to ensure that the various setter methods
are called with the expected values.

We also created a sendWorks method which ensures that the send method is called once
when mailIt is called.

By doing all this we were able to determine if our anticipated API makes sense for
use before we've spent a bunch of time (any time really) building an actual class
that sends mail. It's much simpler to create tests and test code and change that than
to build real classes with real functionality only to determine that things don't look
or act correctly.

With that we had a minor introduction to TDD which will likely be the topic of a future
meeting.