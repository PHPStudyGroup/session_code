# November 30th, 2013

[David Stockton Slideshow on Magic Methods](http://www.slideshare.net/dstockto/php-5-magic-methods)

We had 7 Developers in Attendance. The Topic Covered was PHP Magic Methods.

## List of Magic Methods 
* __construct()
* __destruct()
* __call()
* __get()
* __set()
* __isset()
* __unset()
* __sleep()
* __wakeup()
* __toString()
* __invoke()
* __set_state()
* __clone()
* __callStatic()

## Topics Covered in Session

* **__construct()**
* **__destruct()**
* **__call()**
* **__set()**
* **__isset()**
* **__unset()**


##__construct()

The magic method \__construct() is the first thing called when instatiating a new object of a class. This magic method is normally used to set properties and is considered a best practice to avoid doing any *"Work"* in this magic method. The \__construct() method can accept parameters but is not required and can also be set as private or protected for the PHP visability modifiers. The \__construct() method can be extended to other classes and automatically defaults to the parents __construct() method unless overridden. 

### Default to Parent __Construct

```
 class B
 {
    public function __construct()
    {
        echo 'Created a B';
    }
 }

 class A extends B
 {
 	//No __construct() defined 
 }

 $obj = new A;
```

### Override Parent __Construct()

```
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
    }
 }

 $obj = new A;

```
### Call Parent __Construct()

```
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

```

** Please see [constructor_test.php](https://github.com/mansoormb/session_code/blob/master/November_6_2013/constructor_test.php) for code examples **

##__destruct()

** Called when an object is destroy ** 

Can be triggered when using the unset() method.
 
```

class Bar
{
    protected $name

    public function __construct($name)
    {
        $this->name = $name;

        echo 'Created a new Bar: ', $this->name, "\n";
    }

    public function __destruct()
    {
        echo "Burned {$this->name} to the ground.", "\n";
    }
}

```

** See code example [destructor_test.php](https://github.com/mansoormb/session_code/blob/master/November_6_2013/destructor_test.php) **

##__call()

** is triggered when invoking inaccessible methods in an object context. **

```
class MyClass
{
    public function __call($name, $params)
    {
        echo 'Tried to call ' . $name . "\n";
        var_dump($params);
    }

    public function foo()
    {
        echo 'This be foo, foo!' , "\n";
    }
}

$class = new MyClass;
$class->foobar();

```

** See code example [call_test.php](https://github.com/mansoormb/session_code/blob/master/November_6_2013/call_test.php) or [real_world_call.php](https://github.com/mansoormb/session_code/blob/master/November_6_2013/real_world_call.php) for a real world example **

##__get()
** Getting the value of a property that is not in the current scope **

```
public function __get($name)
    {
        if (isset($this->$name)) {
            return $this->$name;
        }
    }

```
##__set()

**Setting that value of a variable that is not in the current scope **

```
 public function __set($name, $value)
    {
        $this->$name = $value;
    }

```
##__isset()
**Checking if a value isset for a variable not in the current scope **

```
  public function __isset($name)
    {
        return isset($this->$name);
    }

```
##__unset()
** Unsetting a variable nor in the current scope **

```
public function __unset($name)
    {
        unset($this->$name);
    }

```

** For more information view [get_set_isset_unset.php](https://github.com/mansoormb/session_code/blob/master/November_6_2013/get_set_isset_unset.php) **