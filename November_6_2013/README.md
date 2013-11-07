Magic Methods

http://www.slideshare.net/dstockto/php-5-magic-methods

 __construct()

 First thing called when you instantiate a new object of a class. Set variables.
 Avoid doing "work".

 Constructor is not required.

 Does not require parameters. Can pass parameters.

 Call parent constructor:

 class B
 {
    public function __construct()
    {
        echo 'Created a B';
    }
 }

 class A extends B
 {
    public function __construct()
    {
        echo 'Created an A';
        parent::__construct();
    }
 }

 $obj = new A;

 Can you have a private or protected constructor?
 Dave: No
 Tom: No
 Mansoor: Yes

 Correct answer: yes

 How do you create an object if the constructor is not public?


class Bar
{
    private function __construct()
    {
        echo 'I am a secret';
    }

}

$foo = new Bar; // Causes an error

Because it is private, I cannot just called "new" from anywhere.

class BetterBar
{
    protected static $instance;

    private function __construct()
    {
        echo 'I am a secret';
    }

    public static function getInstance()
    {
        if (is_null(self::instance)) {
            // Using static for late static binding
            self::instance = new self;
        }

        return self::instance;
    }
}

// Get instance of BetterBar
$instance = BetterBar::getInstance(); // I am a secret
$instance2 = BetterBar::getInstance(); // Does not create a new instance

class EvenBetterBar extends BetterBar
{

}

$otherInstance = EvenBetterBar::getInstance();

See constructor_test.php


 __destruct()

 Called whenever you destroy an object.

 $foo = new Bar;
 unset($foo);

 new Bar;

See code example

__call()

See code examples


__get()

Getting the the value of a variable that is not in the current scope

__set(),

Setting that value of a variable that is not in the current scope

__isset()

Checking if a value isset for a variable not in the current scope

__unset()

Unsetting a variable not in the current scope

 __sleep(), __wakeup(), __toString(), __invoke(), __set_state() and __clone()
, __callStatic(),

